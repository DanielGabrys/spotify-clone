<?php

namespace App\Models\SpotifyApi;

use Illuminate\Database\Eloquent\Model;


class SpotifyApi extends Model
{

    public static $api_client_id = '0a6e3cc6bbc04d2aa78c49aafd8e1f66';
    public static $client_secret = 'f7c8a67ebed34a659c3094d1c9cc259b';
    private $token;

    public static  $base_url = 'https://api.spotify.com/v1';
    public static $redirect_url = 'http://localhost:8001/callback';
    private static $token_url = 'https://accounts.spotify.com/api/token';

    public $client_id;
    public $playlists;

    public static function getSpotifyToken()
    {

        if(!isset($_GET['code']))
            return false;

        $submit_post_fields = 'grant_type=authorization_code&code=' . $_GET['code'];
        $submit_post_fields .= "&redirect_uri=".SpotifyApi::$redirect_url;

        $access_token = "Basic " . base64_encode(self::$api_client_id.':'.self::$client_secret);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::$token_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $submit_post_fields);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: ' . $access_token, 'Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);;

        curl_close($curl);


        $token = json_decode($response);
        $err = curl_error($curl);

        if (!isset($token->error))
        {
            return $token;
        }

        return false;
    }

    public static function getSpotifyUser($url,$token)
    {

        $curl = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => false,
            CURLOPT_HTTPHEADER => array('Authorization: Bearer ' . $token),
            CURLOPT_RETURNTRANSFER => true
            );

        curl_setopt_array($curl,$options);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if (!$err)
        {
            return $response;
        }

        return ;


    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function setClientId()
    {
        $me = $this->getSpotifyEndPoint('me');
    }



}
