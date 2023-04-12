<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use App\Models\SongTag;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use wapmorgan\Mp3Info\Mp3Info;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class CenterContent extends GlobalMethods
{

    use WithFileUploads;
    use WithPagination;


    protected $listeners = ['refreshPlaylist','refreshTag','refreshSongTag'];

    public  $subView = "";
    public  $MiddleViews = array(
        'songMiddler' => 'livewireMiddlers.songMiddler',
        'playlistMiddler' => 'livewireMiddlers.PlaylistMiddler',
        'addPlaylistMiddler' => 'livewireMiddlers.AddPlaylistMiddler',
    );


    public $dragableSubView ='livewire.play-undraggable-mode';
    public $emptyPlaylistImage = 'storage/images/toFill/emptyPlaylist.png';


    public $AllSongs;
    public $songs;
    public $songs_json;
    public $playlists;
    public $currentPlaylist;
    public $position;
    public $tags;


    public function mount()
    {
        $this->subView = $this->MiddleViews['songMiddler'];
        $this->AllSongs = Song::all();
        $this->songs = Song::all();
        $this->songs_json = $this->songs->toJson();
        $this->playlists = Playlist::all()->sortBy('name');
        $this->tags=$this->setTags();

    }


    public function render()
    {
        return view('livewire.center-content');
    }


    public function SongsMenu()
    {
        $this->subView = $this->MiddleViews['songMiddler'];

    }



    // playlist


    //emit calls
    public function refreshPlaylist()
    {
        $this->playlists = Playlist::all()->sortBy('name');
    }

    public function refreshTag()
    {
        $this->tags = Tag::all();
    }

    public function refreshSongTags()
    {
        $this->tags = [];
        $this->refreshSongTags();
    }

    public function playlist($id)
    {

            $this->currentPlaylist = Playlist::find($id);
            $this->songs = $this->currentPlaylist->songs()->orderBy('position')->get();
            $this->songs_json = $this->songs->toJson();

            $this->dragableSubView ="livewire.play-undraggable-mode";
            $this->subView = "livewire.playlist-details";
    }

    public function addPlaylist()
    {
        $this->subView = $this->MiddleViews['addPlaylistMiddler'];
    }

    public function deletePlaylist($id)
    {


        $this->subView = "livewire.song-menu";
        Playlist::where('id',$id)->delete();
        $this->songs = Song::all();
        $this->playlists = Playlist::all()->sortBy('name');
        $this->currentPlaylist = Playlist::first();


    }

    public function calculatePlaylistTime()
    {
        $time =0;
        foreach ($this->songs as $song )
        {
            $time+= $song->duration;
        }

        return $this->calculateTime($time);
    }

    public function removeSongFromPlaylist($song_id,$pos)
    {

        $song = PlaylistSong::where("playlist_id",$this->currentPlaylist->id)->where('song_id',$song_id)->where('position',$pos);
        $song_position = $song->first()->position;
        $song2 = PlaylistSong::where('position','>',$song_position);


        $song2->update(['position' => DB::raw('position-1')]);
        $song->delete();

        $this->playlist($this->currentPlaylist->id);

    }

    public function ActivateDraggableModule($state,$playlist_id)
    {
        if($state==true)
        {
            $this->dragableSubView ="livewire.playlist-draggable-mode";
        }
        else
        {
            $this->dragableSubView ="livewire.play-undraggable-mode";
        }

        $temp_playlist = Playlist::find($playlist_id);
        $this->songs = $temp_playlist->songs()->orderBy('position')->get();
        $this->songs_json = $this->songs->toJson();
        $this->currentPlaylist = $temp_playlist;


    }

    public function updateSongsOrder($songs)
    {

        foreach ($songs as $song)
        {
         $item = PlaylistSong::where('id',intval($song['value']))->update(['position'=>$song['order']]);
        }

        $this->playlist($this->currentPlaylist->id);
    }





    //tags
    public function tags()
    {
        $this->subView = "livewire.add-song";
    }

    public function generateTagPlaylist()
    {

        $this->subView = "livewire.add-song";
    }



}
