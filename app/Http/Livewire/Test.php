<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\View;
use Livewire\Component;

class Test extends Component
{

    public  $subView = "livewire.test3";



    public function render()
    {
        return view('livewire.test');
    }

    public function test()
    {
      // $this->content = '<h4> vfsdcds </h4> </div>';

        $this->subView = "livewire.song-menu";
        return $this->subView;

    }
}
