<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\Song;
use App\Models\SongTag;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use wapmorgan\Mp3Info\Mp3Info;

class SongMenu extends GlobalMethods
{

    use WithFileUploads;
    use WithPagination;

    protected $listeners = [
        'refreshSongTags'=>'refreshTags',
        'SongsMenu_refreshTags' => "refreshTags",
        'SongsMenu_refreshSongsTags' => "refreshSongsTags"

        ];

    protected $rules = [
            'title' => ['required','min:2','max:255'],
            'author' => ['min:2','max:255'],
            'img' => 'nullable|image|mimes:jpeg,png',
            'songSrc' => ['required','mimes:mp3','max:14000'],

        ];


    protected $paginationTheme = 'bootstrap';


    public $title;
    public $author;
    public $img;
    public $songSrc;
    public $emptySongImage = 'storage/images/toFill/playlist.png';


    public $search;
    public $search_type_track;
    public $search_type_author;
    public $search_tags;

    public $tags;
    public $untagged;



    public function mount()
    {
        $this->search_type_all = 1;
        $this->search_type_track =0;
        $this->search_type_author=0;
        $this->search_tags=[];

        $this->tags = $this->getUserTags();
        $this->setTagsArray();

        $this->untagged=false;

    }

    public function setSearchParameters()
    {
        dd($this->search_tags,$this->untagged);
    }

    public function setSearchTags($id)
    {


       // dd(in_array($id,$this->search_tags));
        if(in_array($id,$this->search_tags))
        {
            $exist = array_search($id,$this->search_tags);
           $this->counter++;
          // dd("elo");
        }
        else
        {

            $this->counter++;
             array_push($this->search_tags,$id);
        }
    }


    public function deleteTagFromSong($song_id,$tag_id)
    {

            SongTag::where('song_id', $song_id)->where('tag_id', $tag_id)->delete();
            $this->emit('refreshSongTagsCenter');
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

        $items = $this->getSearchedSongsWithUserTags(
            $this->search,
            $this->search_type_track,
            $this->search_type_author,
            $this->search_tags,
            $this->untagged);


        return view('livewire.song-menu',[
        'songs' => $items->paginate(10),
        'songs_json' => $items->get()->toJson(),
        'playlists' => $this->getPlaylist(),
        ] );
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function refreshTags()
    {
        $this->tags = $this->getUserTags();
        $this->setTagsArray();
    }

    public function refreshSongsTags()
    {
        $this->updatingSearch();
    }


    public function setTagsArray()
    {

        foreach ($this->tags as $tag)
        {
            $this->search_tags+=array($tag->id => false);
        }

    }

    public function updatingSearch()
    {
        $this->resetPage();
    }




    //songs

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

    }
}
