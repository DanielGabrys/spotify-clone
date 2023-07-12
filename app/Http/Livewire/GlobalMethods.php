<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use App\Models\Tag;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    public function getUserId()
    {
        return $this->user['user_id'];
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

    public function getSearchedSongsWithUserTags($search,$track,$author,$tags,$untagged)
    {

     $search_tags =[];
     foreach ($tags as $key => $item)
     {
         if(!$item)
         array_push($search_tags,$key);
     }

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




      $songs = Song::where(function ($query) use ($search,$track_query,$author_query) {
                $query->where('title', 'LIKE', $track_query)
                    ->orWhere('author', 'LIKE', $author_query);
            });



      // tag selection
        if($untagged)
        {
            $tags= $songs-> whereHas('songsTags',function (Builder $q) use($search_tags) {
                $q->whereIn('tag.id',$search_tags)
                ->where('spotify_user_id', $this->user['user_id']);

            });
        }
        else {
            $tags = $songs->whereDoesntHave('songsTags', function (Builder $q) use ($search_tags,$track_query,$author_query) {
                $q->whereNotIn('tag.id', $search_tags);

            })->
            orWhereHas('songsTags', function (Builder $q) use ($search_tags,$track_query,$author_query) {
                $q->whereIn('tag.id', $search_tags)
                    ->where('spotify_user_id', $this->user['user_id']);


            })->
            where(function ($query) use ($search,$track_query,$author_query) {
                $query->where('title', 'LIKE', $track_query)
                    ->orWhere('author', 'LIKE', $author_query);

            })    ;
        }



        $songsTags = $tags-> with(['songsTags' => function ($q) {
                $q->where('spotify_user_id', $this->user['user_id']);
            }])->
            orderBy('title');

      return $songsTags;

    }

    public function storeSpotifyPlaylist($item)
    {
        $playlist_db = new Playlist();

        $playlist_db ->name = $item -> name;
        $playlist_db ->description = $item -> description;
        $playlist_db ->image =$item ->image ?? Playlist::$image;
        $playlist_db ->spotify_user_id = $this->getUserId();
        $playlist_db ->spotify_playlist_url = $item->spotify_playlist_url;

        $playlist_db->save();

        return $playlist_db->id;
    }

    public function storeTemplatePlaylist($name)
    {

        $playlist = new Playlist;
        $playlist ->name = $name;
        $playlist ->description = Carbon::now()->toDateString();
        $playlist ->image = Playlist::$template_image;
        $playlist->spotify_user_id = $this->user['user_id'];
        $playlist ->spotify_playlist_url = '';


        $playlist->save();

        return $playlist->id;
    }

    public function storeUserPlaylist($name,$description,$image)
    {

        $playlist = new Playlist;
        $playlist ->name = $name;
        $playlist ->description = $description;
        $playlist ->image =Playlist::$image;
        $playlist->spotify_user_id = $this->user['user_id'];
        $playlist ->spotify_playlist_url = '';

        if($image != null)
        {
            $path_playlist = 'public/playlist/img';

            //song image
            $img = $this->playlist_img->store($path_playlist);
            $img = substr($img, 6);
            $Img = "storage" . $img;

            $playlist->image = $Img;
        }


        $playlist->save();

        return $playlist->id;
    }

}
