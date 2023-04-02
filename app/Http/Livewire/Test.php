<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{

    public $content = '<h4> elo </h4> </div>';

    public function render()
    {
        return view('livewire.test');
    }

    public function test()
    {
      // $this->content = '<h4> vfsdcds </h4> </div>';
        return view('welcome');
    }
}
