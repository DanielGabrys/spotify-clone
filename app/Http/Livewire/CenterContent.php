<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use App\Models\Song;
use Livewire\Component;

class CenterContent extends Component
{
    public  $subView = "livewire.blank";
    public $songs;
    public $songs_json;
    public $playlists;

    public function mount()
    {
        $this->songs = Song::all();
        $this->songs_json = $this->songs->toJson();
        $this->playlists = Playlist::all();

    }


    public function render()
    {
        return view('livewire.center-content');
    }

    public function view()
    {
        // $this->content = '<h4> vfsdcds </h4> </div>';

        $this->subView = "livewire.song-menu";
        return $this->subView;

    }

    public function playlist($id)
    {
        $this->songs = Playlist::find($id)->songs()->get();

        $this->subView = "livewire.song-menu";
        return $this->subView;

    }
}
