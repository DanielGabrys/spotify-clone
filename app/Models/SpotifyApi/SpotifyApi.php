<?php

namespace App\Models\SpotifyApi;

use Illuminate\Database\Eloquent\Model;


class SpotifyApi extends Model
{

    public static $token;
    private static $user_id;

    public static  $base_url = 'https://api.spotify.com/v1';
    private static $token_url = 'https://accounts.spotify.com/api/token';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

    }

    public static function getCurrentUserToken($user)
    {
        self::$token = $user['token'];
    }

    public static function getSpotifyToken()
    {

        if(!isset($_GET['code']))
            return false;


        $submit_post_fields = 'grant_type=authorization_code&code=' . $_GET['code'];
        $submit_post_fields .= "&redirect_uri=".config('app.redirect_url');

        dd($submit_post_fields);
        $access_token = "Basic " . base64_encode(config('app.spotify_client_id').':'.config('app.spotify_client_secret'));

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::$token_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $submit_post_fields);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: ' . $access_token, 'Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);;

        curl_close($curl);


        $token = json_decode($response);
        dd($response);
        $err = curl_error($curl);

        if (!isset($token->error) && isset($token))
        {
            self::$token = $token->access_token;
            return $token->access_token;
        }

        return false;
    }

    public static function getUserSpotifyToken()
    {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,            self::$token_url );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($curl, CURLOPT_POST,           true );
        curl_setopt($curl, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' );
        curl_setopt($curl, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode(config('app.spotify_client_id').':'.config('app.spotify_client_secret')),'Content-Type:application/x-www-form-urlencoded'));


        $response = curl_exec($curl);;

        curl_close($curl);

        $token = json_decode($response);
        $err = curl_error($curl);

        if (!isset($token->error) && isset($token))
        {
            self::$token = $token->access_token;
            return $token->access_token;
        }

        return false;
    }


    public static function getSpotifyEnpoint($url)
    {

        $curl = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => false,
            CURLOPT_HTTPHEADER => array('Authorization: Bearer ' . self::$token),
            CURLOPT_RETURNTRANSFER => true
            );

        curl_setopt_array($curl,$options);

        $response = curl_exec($curl);
        //dd($response);
        $err = curl_error($curl);
        curl_close($curl);

        if (!$err)
        {
            return json_decode($response,true);
        }


        return $err;

    }

    public static function storeSpotifyEndpoint($url,$request)
    {

        $curl = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_HTTPHEADER => array('Authorization: Bearer ' . self::$token,'Content-Type: application/json'
            ),
            CURLOPT_RETURNTRANSFER => 1
        );

        curl_setopt_array($curl,$options);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if (!$err)
        {
            return json_decode($response,true);
        }

        return $err;

    }

    public static function getUser()
    {
        $endpoint = 'https://api.spotify.com/v1/me';
        $result = SpotifyApi::getSpotifyEnpoint($endpoint);
        self::$user_id = $result['id'];
        return $result;

    }

    public static function getUserPlaylists($id)
    {
        $endpoint = 'https://api.spotify.com/v1/users/'.$id.'/playlists?limit=50';
        $result = SpotifyApi::getSpotifyEnpoint($endpoint);
        SpotifyPlaylist::playlistToCollection($result);

        return $result;
    }

    public static function getPlaylistItems($id)
    {

        $endpoint = 'https://api.spotify.com/v1/playlists/'.$id.'/tracks';
        $result = SpotifyApi::getSpotifyEnpoint($endpoint);

        return $result;
    }

    public static function getUserTracks()
    {
        $endpoint = 'https://api.spotify.com/v1/me/tracks';
        $result = SpotifyApi::getSpotifyEnpoint($endpoint);

        dd($result);
        return $result;
    }


    public function getClientId()
    {
        return $this->client_id;
    }

    public static function getUserId()
    {
        return self::$user_id;
    }


    public static function getDevices()
    {
       $endpoint =  'https://api.spotify.com/v1/me/player/devices';
       $result = SpotifyApi::getSpotifyEnpoint($endpoint);


        return $result['devices'][0]['id'];
    }

    public static function getPlayerState()
    {
        $endpoint =  'https://api.spotify.com/v1/me/player';
        $result = SpotifyApi::getSpotifyEnpoint($endpoint);

      //  dd($result);
    }

    public static function storePlaylist($user,$data)
    {

        $endpoint =  'https://api.spotify.com/v1/users/'.$user['user_id'].'/playlists';
        self::getCurrentUserToken($user);
        return self::storeSpotifyEndpoint($endpoint,$data);

    }

    public static function storePlaylistItems($playlist_id,$data)
    {

        $endpoint =  'https://api.spotify.com/v1/playlists/'.$playlist_id.'/tracks';
        $result = self::storeSpotifyEndpoint($endpoint,$data);

       // dd($result);
    }


}
