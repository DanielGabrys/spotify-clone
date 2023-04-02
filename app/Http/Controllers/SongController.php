<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function showSongs()
    {
        $songs = Song::all();
        $songs_json = $songs->toJson();

        return view('Center',['songs'=>$songs,'songs_json' =>$songs_json]);
    }

    public function test()
    {
        $songs = Song::all();
        $songs_json = $songs->toJson();

        return view('test',['songs'=>$songs,'songs_json' =>$songs_json]);
    }
}
