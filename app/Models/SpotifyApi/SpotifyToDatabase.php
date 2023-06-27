<?php

namespace App\Models\SpotifyApi;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use App\Models\SongTag;
use Illuminate\Database\Eloquent\Model;

class SpotifyToDatabase extends Model
{

    public  $songs;
    public  $explored_track = [];
    public  $explored_track_id = [];

    public function __construct()
    {
       $this->songs = Song::all();

    }

    public function savePlaylist($playlist)
    {
        $item = new SpotifyPlaylist($playlist);

        $playlist_db = new Playlist();

        $playlist_db ->name = $item -> name;
        $playlist_db ->description = $item -> description;
        $playlist_db ->image =$item ->image ?? Playlist::$image;
        $playlist_db ->spotify_user_id = SpotifyApi::getUserId();

        $playlist_db->save();

        return $playlist_db->id;
    }

    public function saveSongsToDatabaseFromPlaylist($playlist_tracks,$playlist_id)
    {
        foreach ($playlist_tracks['items'] as $track)
        {

            $track_db = new SpotifyTrack($track['track']);
            $exist=  self::filterSongs($this->songs,$track_db->spotify_track_id);

            if($exist!=null)
            {

                    $this->addSongToDatabasePlaylist($exist,$playlist_id);
            }
            else
            {

                if(!$track_db->spotify_track_id)
                    continue;

                     if(!in_array($track_db->spotify_track_id,$this->explored_track))
                     {
                        //save song to song table
                        array_push($this->explored_track,$track_db->spotify_track_id);


                         $song_id= $this->saveSongTodatabase($track_db);
                         array_push($this->explored_track_id,$song_id);


                         //save song to pivot table
                         $this->addSongToDatabasePlaylist($song_id,$playlist_id);


                     }
                     else
                     {
                         //save song to pivot table

                         $key = array_search($track_db->spotify_track_id,$this->explored_track);
                         $this->addSongToDatabasePlaylist($this->explored_track_id[$key],$playlist_id);

                     }

            }


        }

       // dd($this->explored_track);

    }

    public static function filterSongs($songs,$id)
    {
        $song = $songs->where('spotify_track_id',$id);
        if($song->count() >0)
            return $song->first()->id;
        return null;

    }

    public function saveSongTodatabase($track)
    {

        $song = new Song();

        $song->title = $track->title;
        $song->author = $track->author;
        $song->image =$track->image;
        $song->src = $track->src;
        $song->duration = $track->duration;
        $song->spotify_track_id = $track->spotify_track_id;
        $song->save();


        return $song->id;

    }

    public function addSongToDatabasePlaylist($song_id,$playlist_id)
    {
        $playlist_song = new PlaylistSong();
        $playlist_song->song_id = $song_id;

        $position = PlaylistSong::where("playlist_id",$playlist_id)->max('position');
        $position = is_numeric($position) ? ++$position:1;
        $playlist_song->position = $position;

        $playlist_song->playlist_id = $playlist_id;

        $playlist_song->save();
    }

}
