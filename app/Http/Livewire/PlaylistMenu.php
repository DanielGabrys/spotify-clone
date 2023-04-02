<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use Livewire\Component;

class PlaylistMenu extends Component
{

    public $playlists;
    public $songs;

    public function mount($playlistId)
    {
        $this->playlist = Playlist::find($playlistId);
        $this->songs = $this->playlist->songs()->get();
    }

    public function render()
    {
        return view('livewire.playlist-menu');
    }

    public function playlist()
    {
        // $this->content = '<h4> vfsdcds </h4> </div>';

        $this->subView = "livewire.song-menu";
        return $this->subView;

    }
}
