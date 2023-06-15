<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use App\Models\SpotifyApi\SpotifyApi;
use App\Models\SpotifyApi\SpotifyPlaylist;
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


        $user = SpotifyApi::getUser();
        $playlists =  SpotifyApi::getUserPlaylists($user['id']);
        $this->loadPlaylistToDatabase($playlists);

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

    public function loadPlaylistToDatabase($playlists)
    {

        Playlist::where('spotify_user_id',SpotifyApi::getUserId())->delete();
        foreach ($playlists['items'] as $playlist)
        {

            $item = new SpotifyPlaylist($playlist);

            $playlist_db = new Playlist();

            $playlist_db ->name = $item -> name;
            $playlist_db ->description = $item -> description;
            $playlist_db ->image =$item ->image ?? Playlist::$image;
            $playlist_db ->spotify_user_id = SpotifyApi::getUserId();

            $playlist_db->save();

        }
    }

}
