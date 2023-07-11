<?php

namespace App\Models\SpotifyApi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotifyPlaylist extends Model
{

    public $id;
    public $name;
    public $description;
    public $image;

    public $spotify_playlist_url;


    public function __construct($playlist)
    {
        $this->id = $playlist['id'];
        $this->name = $playlist['name'];
        $this->href = $playlist['description'];
        $this->image = $playlist['images'][0]["url"] ?? null;
        $this->spotify_playlist_url = '';

    }


    public function setDetails($details)
    {
        $this->spotify_playlist_url = $details['external_urls']['spotify'];
    }


    public static function playlistToCollection($playlists)
    {

        $collection = collect([]);

        foreach ($playlists['items'] as $playlist)
        {

            $item = new SpotifyPlaylist($playlist);
            $collection->push($item);
        }

    }




}
