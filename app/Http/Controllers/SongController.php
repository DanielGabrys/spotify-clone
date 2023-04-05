<?php

namespace App\Http\Controllers;

use App\Http\Livewire\PlaylistMenu;
use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function showSongs()
    {
        $songs = Song::all();
        $songs_json = $songs->toJson();
        $playlists = Playlist::all();


        return view('sidebars.Main',['songs'=>$songs,'songs_json' =>$songs_json,'playlists'=>$playlists]);
    }


}
