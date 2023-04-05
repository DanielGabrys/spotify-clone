<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\PlaylistSong;
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
        $this->songs_json = $this->allSongs->toJson();
        $this->subView = "livewire.song-menu";

    }

    public function addSong()
    {

        $this->subView = "livewire.add-song";

    }

    public function addSongToPlaylist($song_id,$playlist_id)
    {
        $playlist_song = new PlaylistSong();
        $playlist_song->song_id = $song_id;
        $playlist_song->playlist_id = $playlist_id;

        $playlist_song->save();
       // $this->playlist($playlist_id);


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

    public function addSongForm()
    {

        $song = new Song();
        $song->title = $this->title;
        $song->author = $this->author;

        $path_music = 'public/music';
        $path_image = 'public/images/songs';



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

       // $song->duration = $this->calculateTime($audio->duration);
        $song->duration = $audio->duration;
        $song->save();

        $this->songs();

    }

    public function calculateTime($sec)
    {
        $minutes = floor($sec / 60);
        $seconds = floor($sec % 60);
        $returnSec = $seconds < 10 ? '0'.$seconds:$seconds;
        return $minutes.':'.$returnSec;
    }

    public function calculatePlaylistTime()
    {
        $time =0;
        foreach ($this->songs as $song )
        {
            $time+= $song->duration;
        }

        return $this->calculateTime($time);
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
        $this->songs_json = $this->songs->toJson();
        $this->subView = "livewire.playlist-details";


    }

    public function removeSongFromPlaylist($song_id,$playlist_id)
    {
        PlaylistSong::where('song_id',$song_id)->where('playlist_id',$playlist_id)->delete();

        $this->playlist($playlist_id);
    }
}
