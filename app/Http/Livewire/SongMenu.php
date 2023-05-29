<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\Song;
use App\Models\SongTag;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use wapmorgan\Mp3Info\Mp3Info;

class SongMenu extends GlobalMethods
{

    use WithFileUploads;
    use WithPagination;
    protected $listeners = [
        'refreshSongTags'=>'refreshTags',
        ];

    protected $paginationTheme = 'bootstrap';

    // addSongForm
    public $title;

    public $author;
    public $img;
    public $songSrc;
    public $emptySongImage = 'storage/images/toFill/playlist.png';

    protected $rules = [
        'title' => ['required','min:2','max:255'],
        'author' => ['min:2','max:255'],
        'img' => 'nullable|image|mimes:jpeg,png',
        'songSrc' => ['required','mimes:mp3','max:14000'],

    ];

    public function deleteTagFromSong($song_id,$tag_id)
    {

        if(Tag::find($tag_id)->name!="-")
        {
            SongTag::where('song_id', $song_id)->where('tag_id', $tag_id)->delete();
            $this->tags = $this->setTags();
            $this->emit('refreshSongTagsCenter');
        }
    }


    public function refreshTags()
    {
        $this->tags=$this->setTags();
    }


    //songs
    public function songs()
    {

        /*
        $this->songs = Song::all();
        dd($this->$this->songs);
        $this->songs_json = $this->songs->toJson();
        $this->subView = "livewire.song-menu";
        */



    }

    public function addSongForm()
    {
        $this->validate($this->rules);



        $song = new Song();
        $song->title = $this->title;
        $song->author = $this->author;
        $song->image =$this->emptySongImage;

        $path_music = 'public/music';
        $path_image = 'public/images/songs';


        $Img ='';
        if($this->img != null)
        {

            //song image
            $img= $this->img->store($path_image);
            $img = substr($img,6);
            $Img= "storage".$img;

            $song->image = $Img;
        }

        //song track
        $scr = $this->songSrc->store($path_music);
        $scr = substr($scr, 6);
        $src = "storage" . $scr;

        $song->src = $src;


        $audio = new Mp3Info($src);

        // $song->duration = $this->calculateTime($audio->duration);
        $song->duration = $audio->duration;
        $song->save();

        $this->resetValidationData();

        //tag

        $songTag = new SongTag();
        $songTag -> song_id = $song->id;
        $songTag -> tag_id = 1;

        $songTag->save();


        $this->tags = $this->setTags();


           // dd($this->tags);
;


    }

    public function deleteSong($id)
    {
        $song = Song::where('id',$id);
        $songData = $song->get()->first();


        Storage::delete($songData->image);
        Storage::delete($songData->src);

        $song->delete();
        $this->render();
    }


    public function resetValidationData()
    {
        // addSongForm
        $this-> title ='';
        $this-> author ='';
        $this-> img = null;
        $this-> songSrc = '';
    }

    public function render()
    {
        return view('livewire.song-menu',[
        'songs' => Song::orderBy('title')->paginate(8),
        'songs_json' => Song::orderBy('title')->get()->toJson(),
        'playlists' => Playlist::all(),
        'tags' => $this->setTags(),
        ] );
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

}
