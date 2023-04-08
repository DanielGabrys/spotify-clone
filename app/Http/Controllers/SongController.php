<?php

namespace App\Http\Controllers;

use App\Http\Livewire\PlaylistMenu;
use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use App\Models\Tag;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function showSongs()
    {
        $songs = Song::all();
        $songs_json = $songs->toJson();
        $playlists = Playlist::all();
        $tags =Tag::all()->where('name','=','jive');


        return view('sidebars.Main',['songs'=>$songs,
            'songs_json' =>$songs_json,
            'playlists'=>$playlists,
            'tags'=>$tags]);
    }


}
