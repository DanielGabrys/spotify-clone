<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use App\Models\SpotifyApi\SpotifyApi;
use App\Models\SpotifyApi\SpotifyUser;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use function Symfony\Component\String\u;

class CenterContent extends GlobalMethods
{

    use WithFileUploads;
    use WithPagination;


    protected $listeners =
        ['refreshPlaylist',
        'CenterContent_playlistImported' => 'refreshImportedPlaylist'];

    public  $subView = "";
    public  $MiddleViews = array(
        'songMiddler' => 'livewireMiddlers.songMiddler',
        'playlistMiddler' => 'livewireMiddlers.PlaylistMiddler',
        'addPlaylistMiddler' => 'livewireMiddlers.AddPlaylistMiddler',
        'templateMiddler' => 'livewireMiddlers.TemplateMiddler',
    );


    public $dragableSubView ='livewire.play-undraggable-mode';
    public $emptyPlaylistImage = 'storage/images/toFill/emptyPlaylist.png';


    public $songs;
    public $songs_json;
    public $playlists;
    public $currentPlaylist;
    public $position;
    public $tags;


    public function mount()
    {
        $this->subView = $this->MiddleViews['songMiddler'];
        $this->user = json_decode(json_encode(new SpotifyUser($this->user)),true);
        $this->playlists = $this->getPlaylist();



    }


    //emit calls
    public function refreshPlaylist()
    {
        $this->playlists = $this->getPlaylist();

    }

    public function refreshImportedPlaylist($playlists)
    {

        $this->playlists = $this->getUploadedPlaylist($playlists);
        $this->emit('SpotifyPlaylistMigrate_refreshImported');
    }



    //playlist
    public function playlist($id)
    {

            $this->currentPlaylist = Playlist::where('id',$id)->first();
            $this->songs = $this->getPlaylistSongsWithUserTags($this->currentPlaylist);

            $this->songs_json = $this->songs->toJson();

            $this->dragableSubView ="livewire.play-undraggable-mode";
            $this->subView = "livewire.playlist-details";
    }

    public function deletePlaylist($id)
    {


        $this->subView = $this->MiddleViews['addPlaylistMiddler'];
        Playlist::where('id',$id)->delete();

        $this->playlists = $this->getPlaylist();
        $this->currentPlaylist = Playlist::first() ?? 0;

        if($this->currentPlaylist)
        $this->songs = $this->getPlaylistSongsWithUserTags($this->currentPlaylist);



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

        $song = PlaylistSong::where("playlist_id",$this->currentPlaylist->id)->where('song_id',$song_id);
        $song2 = PlaylistSong::where('position','>',$pos);

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
        $this->songs = $this->getPlaylistSongsWithUserTags($temp_playlist);
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


    //subviews
    public function tags()
    {
        $this->subView = "livewire.add-song";
    }

    public function generateTagPlaylist()
    {
        $this->subView = $this->MiddleViews['templateMiddler'];
    }

    public function addPlaylist()
    {
        $this->subView = $this->MiddleViews['addPlaylistMiddler'];
    }


    public function SongsMenu()
    {
        $this->subView = $this->MiddleViews['songMiddler'];

    }

    public function render()
    {
        return view('livewire.center-content');
    }


}
