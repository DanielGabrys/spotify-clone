<?php

namespace App\Models\SpotifyApi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotifyUser
{

    public $name;
    public $href;
    public $image;
    public $spotify_profile;
    public $token;

    public $user_id;

    public function __construct($user)
    {
        $this->user_id =$user['id'];
        $this->name = $user['display_name'];
        $this->href = $user['href'];
        $this->image =$user['images'][0]["url"];
        $this->spotify_profile = $user['external_urls']['spotify'];
        $this->token = SpotifyApi::getCurrentUserToken();

    }


    public static function getUserId()
    {
        return self::$user_id;
    }


}
