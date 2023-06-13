<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use App\Models\SpotifyApi\SpotifyApi;
use App\Models\SpotifyApi\SpotifyUser;

class SpotifyController extends Controller
{
    public function authorizeSpotify()
    {
        return view('welcome');

    }

    public function authorizeCallback()
    {


        $token = SpotifyApi::getSpotifyToken();

        if(!$token)
            return   view('welcome');

        $endpoint = 'https://api.spotify.com/v1/me';
        $me = SpotifyApi::getSpotifyUser($endpoint, $token->access_token);
        $user= json_decode($me, true);



        $user = new SpotifyUser($user);
        $user = json_decode(json_encode($user), true);

       // dd($user);

        return $this->index($user);

    }

    public function index($user)
    {
        $songs = Song::with("songsTags");
        $songs_json = $songs->get()->toJson();


        return view('sidebars.Main',[
            'songs_json' =>$songs_json,
            'user' => $user,
        ]);
    }

}
