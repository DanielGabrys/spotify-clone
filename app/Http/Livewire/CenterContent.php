<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use wapmorgan\Mp3Info\Mp3Info;

class CenterContent extends Component
{
    use WithFileUploads;


    public  $subView = "livewire.blank";
    public $allSongs;
    public $songs;
    public $songs_json;
    public $playlists;

    // addSongForm
    public $title;
    public $author;
    public $img;
    public $songSrc;

    public function mount()
    {
        $this->allSongs = Song::all();
        $this->songs = Song::all();
        $this->songs_json = $this->songs->toJson();
        $this->playlists = Playlist::all();

    }


    public function render()
    {
        return view('livewire.center-content');
    }

    public function songs()
    {
        // $this->content = '<h4> vfsdcds </h4> </div>';

        $this->allSongs = Song::all();
        $this->subView = "livewire.song-menu";

    }

    public function addSong()
    {
        // $this->content = '<h4> vfsdcds </h4> </div>';

        $this->subView = "livewire.add-song";

    }

    public function addSongForm()
    {
        // $this->content = '<h4> vfsdcds </h4> </div>';


        $song = new Song();
        $song->title = $this->title;
        $song->author = $this->author;

        $path_music = 'public/music';
        $path_image = 'public/images';



        //song track
        $scr= $this->songSrc->store($path_music);
        $scr = substr($scr,6);
        $src= "storage".$scr;

        //song image
        $img= $this->img->store($path_image);
        $img = substr($img,6);
        $Img= "storage".$img;

        $song->src = $src;
        $song->image = $Img;

        $audio = new Mp3Info($src);
        dd($audio);
        $song->save();


    }


    public function tags()
    {
        // $this->content = '<h4> vfsdcds </h4> </div>';

        $this->subView = "livewire.add-song";

    }

    public function generateTagPlaylist()
    {
        // $this->content = '<h4> vfsdcds </h4> </div>';

        $this->subView = "livewire.add-song";

    }


    public function playlist($id)
    {
        $this->songs = Playlist::find($id)->songs()->get();

        $this->subView = "livewire.playlist-details";


    }
}
