<?php

namespace App\Http\Livewire;

use App\Models\Song;
use Livewire\Component;

class FilterSongs extends Component
{

    public $search;
    public $searched_songs;

    public function search()
    {

        if(!empty($this->search))
        {
            $this->searched_songs = Song::where('title','LIKE',"%{$this->search}%")->get();
        }

      //  $this->emit('SongsMenu_refreshSongs');

    }



    public function render()
    {
        return view('livewire.filter-songs');
    }


}
