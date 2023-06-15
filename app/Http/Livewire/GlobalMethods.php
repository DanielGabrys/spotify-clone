<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use Livewire\Component;

class GlobalMethods extends Component
{

    public $user;

    public function render()
    {
        return view('livewire.global-methods');
    }

    public function calculateTime($sec)
    {
        $minutes = floor($sec / 60);
        $seconds = floor($sec % 60);
        $returnSec = $seconds < 10 ? '0'.$seconds:$seconds;
        return $minutes.':'.$returnSec;

    }

    public function addSongToPlaylist($song_id,$playlist_id)
    {


        $playlist_song = new PlaylistSong();
        $playlist_song->song_id = $song_id;

        $position = PlaylistSong::where("playlist_id",$playlist_id)->max('position');
        $position = is_numeric($position) ? ++$position:1;
        $playlist_song->position = $position;

        $playlist_song->playlist_id = $playlist_id;

        $playlist_song->save();


    }

    public function getPlaylist()
    {
        return Playlist::where('spotify_user_id',$this->user['user_id'])->orderBy('name')->get();
    }


}
