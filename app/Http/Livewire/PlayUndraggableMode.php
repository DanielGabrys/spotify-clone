<?php

namespace App\Http\Livewire;

use App\Models\PlaylistSong;
use Livewire\Component;

class PlayUndraggableMode extends Component
{
    public function render()
    {
        return view('livewire.play-undraggable-mode');
    }

    public $playlistSongs;

    public function mount($songs)
    {
        $this->playlistSongs = $songs;
    }


    public function updateSongsOrder($songs)
    {

        foreach ($songs as $song)
        {
            $item = PlaylistSong::where('id',intval($song['value']))->update(['position'=>$song['order']]);
        }

        $this->playlist($this->currentPlaylist);
    }
}
