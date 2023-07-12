<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use App\Models\SpotifyApi\SpotifyApi;
use App\Models\SpotifyApi\SpotifyPlaylist;
use App\Models\SpotifyApi\SpotifyTrack;
use Livewire\Component;

class SpotifyPlaylistMigrate extends GlobalMethods
{

    protected $listeners =
        ['SpotifyPlaylistMigrate_refreshImported'=> 'savePlaylistToDatabase'];

    public function render()
    {
        return view('livewire.spotify-playlist-migrate');
    }

    public  $songs;
    public  $explored_track = [];
    public  $explored_track_id = [];

    public $total_playlists;
    public $current_playlist=0;
    public $playlists;
    public $progress;

    public function mount()
    {
        $this->current_playlist=0;
        $this->songs = Song::all();
        $this->progress='';

    }

    public function updatePlaylistsFromSpotify()
    {
        $this->savePlaylistToDatabase();
    }

    public function savePlaylist($playlist,$details)
    {
        $item = new SpotifyPlaylist($playlist);
        $item->setDetails($details);

        $playlist_id = $this->storeSpotifyPlaylist($item);

        return $playlist_id;
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
        $song->spotify_track_url = $track->spotify_track_url;
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

    public function savePlaylistToDatabase()
    {
        if($this->current_playlist==0)
        {
            Playlist::where('spotify_user_id', $this->getUserId())->delete();
            $this->playlists =  SpotifyApi::getUserPlaylists($this->user);
            $this->total_playlists = $this->playlists['total'];
            $this->current_playlist = 0;

            $this->progress=($this->current_playlist+1).'/'.$this->total_playlists;


        }

        if(count($this->playlists['items']) > $this->current_playlist)
        {
            SpotifyApi::setUserToken($this->user);

            $playlist = $this->playlists['items'][$this->current_playlist];
            $playlist_details = SpotifyApi::getPlaylistDetails($playlist['id']);
            $playlist_id = $this->savePlaylist($playlist,$playlist_details);
            $tracks = SpotifyApi::getPlaylistItems($playlist['id']);
            $this->saveSongsToDatabaseFromPlaylist($tracks, $playlist_id);
            $this->current_playlist++;
            $this->progress=$this->current_playlist.'/'.$this->total_playlists;
            $this->emit('CenterContent_playlistImported');

        }
        else
        {
            $this->current_playlist=0;
            $this->progress='zakończono';

        }

    }
}
