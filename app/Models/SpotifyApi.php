<?php

namespace App\Models;

use Aerni\Spotify\Spotify;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotifyApi extends Model
{

    private $api_client_id = '0a6e3cc6bbc04d2aa78c49aafd8e1f66';
    private $client_secret = 'f7c8a67ebed34a659c3094d1c9cc259b';
    private $token;

    public  $base_url = 'https://api.spotify.com/v1';
    public $token_url = 'https://accounts.spotify.com/api/token';

    public $client_id;
    public $playlists;

    private $user_id = '316pmo3dmirxms5w24e6qvbxudzi';

    //$track = "https://api.spotify.com/v1/" . $name;


    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
       // $this->playlists = 'https://api.spotify.com/v1/users/'.$this->client_id.'/playlists';

    }

    public function getSpotifyToken()
    {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->token_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . base64_encode($this->api_client_id . ':' . $this->client_secret)));

        $response = curl_exec($curl);;
        $token = json_decode($response)->access_token;
        $err = curl_error($curl);
        curl_close($curl);


        if (!$err)
        {
            echo $token;
            $this->token = $token;
        }

       // $this->setClientId();
    }

    function getSpotifyEndPoint($url)
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array("Content-Type: application/json", "Authorization: Bearer ".$this->token,
            ),
        ));

        $response = curl_exec($curl);
        echo $response;
        $err = curl_error($curl);
        curl_close($curl);

        if (!$err)
        {
            return $response;
        }


    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function setClientId()
    {
        $me = $this->getSpotifyEndPoint('me');
    }

    public function getUserId()
    {
        return $this->user_id;
    }


}
