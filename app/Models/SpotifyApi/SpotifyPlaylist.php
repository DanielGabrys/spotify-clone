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


    public function __construct($playlist)
    {
        $this->id = $playlist['id'];
        $this->name = $playlist['name'];
        $this->href = $playlist['description'];
        $this->image = $playlist['images'][0]["url"] ?? null;
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
