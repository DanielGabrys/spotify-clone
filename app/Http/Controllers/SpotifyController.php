<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use App\Models\SpotifyApi\SpotifyApi;
use App\Models\SpotifyApi\SpotifyToDatabase;

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

        $db = new SpotifyToDatabase();

        Playlist::where('spotify_user_id',SpotifyApi::getUserId())->delete();
        foreach ($playlists['items'] as $playlist)
        {


            $playlist_id = $db->savePlaylist($playlist);
            $tracks = SpotifyApi::getPlaylistItems($playlist['id']);
            $db->saveSongsToDatabaseFromPlaylist($tracks,$playlist_id);



        }
    }



}
