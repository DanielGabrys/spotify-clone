<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use wapmorgan\Mp3Info\Mp3Info;

class SongMenu extends CenterContent
{

    public $Songs;
    public $songs_json;

    // addSongForm
    public $title;
    public $Playlists;
    public $author;
    public $img;
    public $songSrc;
    public $emptySongImage = 'storage/images/toFill/playlist.png';

    protected $rules = [
        'title' => ['required','min:2','max:255'],
        'author' => ['min:2','max:255'],
        'img' => 'nullable|image|mimes:jpeg,png',
        'songSrc' => ['required','mimes:mp3','max:10000'],

    ];

    public function mount()
    {
        $this->Songs = Song::all();
        $this->Playlists = Playlist::all();
    }


    //songs
    public function songs()
    {
        // $this->content = '<h4> vfsdcds </h4> </div>';

        $this->Songs = Song::all();
        $this->songs_json = $this->Songs->toJson();
        $this->subView = "livewire.song-menu";


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

        $this->songs();

    }

    public function deleteSong($id)
    {
        $song = Song::where('id',$id);
        $songData = $song->get()->first();


        Storage::delete($songData->image);
        Storage::delete($songData->src);

        $song->delete();
        $this->songs();
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
        return view('livewire.song-menu');
    }
}
