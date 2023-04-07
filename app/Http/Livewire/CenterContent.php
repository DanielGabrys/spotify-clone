<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use wapmorgan\Mp3Info\Mp3Info;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class CenterContent extends Component
{
    use WithFileUploads;


    protected $listeners = ['refreshPlaylist'];

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
    public $currentPlaylist =0;
    public $position;


    public function mount()
    {
        $this->subView = $this->MiddleViews['songMiddler'];
        $this->AllSongs = Song::all();
        $this->songs = Song::all();
        $this->songs_json = $this->songs->toJson();
        $this->playlists = Playlist::all();
    }


    public function render()
    {
        return view('livewire.center-content');
    }


    public function SongsMenu()
    {
        $this->subView = $this->MiddleViews['songMiddler'];

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
       // $this->playlist($playlist_id);


    }



    // playlist

    public function refreshPlaylist()
    {
        $this->playlists = Playlist::all();
    }

    public function playlist($id)
    {

            $this->currentPlaylist = Playlist::find($id);
            $this->songs = $this->currentPlaylist->songs()->orderBy('position')->get();
            $this->songs_json = $this->songs->toJson();
            $this->currentPlaylist = $this->currentPlaylist->first();

            $this->subView = "livewire.playlist-details";
    }

    public function addPlaylist()
    {
        $this->subView = $this->MiddleViews['addPlaylistMiddler'];
    }

    public function deletePlaylist($id)
    {


        Playlist::where('id',$id)->delete();
        $this->playlists = Playlist::all();
        $this->songs = Song::all();
        $this->subView = "livewire.song-menu";

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
        $this->currentPlaylist = $temp_playlist->first();

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
        // $this->content = '<h4> vfsdcds </h4> </div>';

        $this->subView = "livewire.add-song";

    }

    //functional
    public function calculateTime($sec)
    {
        $minutes = floor($sec / 60);
        $seconds = floor($sec % 60);
        $returnSec = $seconds < 10 ? '0'.$seconds:$seconds;
        return $minutes.':'.$returnSec;
    }


}
