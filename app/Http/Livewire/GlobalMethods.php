<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use App\Models\Tag;
use App\Models\Template;
use Livewire\Component;

class GlobalMethods extends Component
{

    public $user;

    public function render()
    {
        return view('livewire.global-methods');
    }

    public function calculateTime($sec)
    {
        $minutes = floor($sec / 60);
        $seconds = floor($sec % 60);
        $returnSec = $seconds < 10 ? '0'.$seconds:$seconds;
        return $minutes.':'.$returnSec;

    }

    public function addSongToPlaylist($song_id,$playlist_id)
    {


        $playlist_song = new PlaylistSong();
        $playlist_song->song_id = $song_id;

        $position = PlaylistSong::where("playlist_id",$playlist_id)->max('position');
        $position = is_numeric($position) ? ++$position:1;
        $playlist_song->position = $position;

        $playlist_song->playlist_id = $playlist_id;

        $playlist_song->save();


    }

    public function getPlaylist()
    {
        return Playlist::where('spotify_user_id',$this->user['user_id'])->orderBy('name')->get();
    }

    public function getUserTags()
    {

        return Tag::where('spotify_user_id',$this->user['user_id'])->orderBy('name')->get();
    }

    public function getPlaylistSongsWithUserTags($playlist)
    {

        return $playlist->songs()->with(['songsTags' => function ($q)
        {
            $q->where('spotify_user_id',$this->user['user_id']);
        }])->
        orderBy('position')->get();
    }

    public function getSongsWithUserTags()
    {

        return Song::with(['songsTags' => function ($q)
        {
            $q->where('spotify_user_id',$this->user['user_id']);
        }])->
        orderBy('title');
    }

    public function getUserTemplates()
    {
        return Template::where("spotify_user_id", $this->user['user_id'])->orderBy('created_at')->get();
    }

    public function getUserTagByName($name)
    {
        return Tag::where('spotify_user_id',$this->user['user_id'])->where('name',$name)->first();

    }

    public function getSearchedSongsWithUserTags($search,$track,$author)
    {

      $track_query ='%'.$search.'%';
      $author_query = '%'.$search.'%';

      if($track)
      {
          $author_query = '';
      }

      if($author)
      {
            $track_query = '';
      }

      if(($author && $track))
      {
            $track_query ='%'.$search.'%';
            $author_query = '%'.$search.'%';
      }

            return Song::where(function ($query) use ($search,$track_query,$author_query) {
                $query->where('title', 'LIKE', $track_query)
                    ->orWhere('author', 'LIKE', $author_query);
            })->
            with(['songsTags' => function ($q) {
                $q->where('spotify_user_id', $this->user['user_id']);
            }])->
            orderBy('title');


    }

}
