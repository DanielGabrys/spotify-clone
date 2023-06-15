<?php

namespace App\Models\SpotifyApi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotifyTrack extends Model
{
    public $id;
    public $spotify_track_id;
    public $title;
    public $author;
    public $image;
    public $src;
    public $duration;


    public function __construct($track)
    {
        $this->spotify_track_id= $track['id'];
        $this->title = $track['name'];
        $this->author = $track['artists'][0]['name'];
        $this->image = $track['album']['images'][0]["url"] ?? null;
        $this->src = "-";
        $this->duration=$track['duration_ms']/1000;
    }

}
