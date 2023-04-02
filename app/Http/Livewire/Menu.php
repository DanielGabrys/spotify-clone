<?php

namespace App\Http\Livewire;

use App\Models\Song;
use Livewire\Component;

class Menu extends Component
{
    public  $subView = "livewire.test3";
    public $songs;
    public $songs_json;

    public function mount($songs,$songs_json)
    {
        $this->songs = Song::all();
        $this->songs_json = $songs->toJson();
    }

    public function render()
    {
        return view('livewire.menu');
    }

    public function test()
    {
        // $this->content = '<h4> vfsdcds </h4> </div>';

        $this->subView = "livewire.test2";
        return $this->subView;

    }
}
