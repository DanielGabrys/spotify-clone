<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use Livewire\Component;

class AddPlaylist extends Component
{

    public $playlists;
    public $emptyPlaylistImage = 'storage/images/toFill/emptyPlaylist.png';

    // addPlaylistForm
    public $playlist_name;
    public $playlist_description;
    public $playlist_img = 'storage/images/toFill/emptyPlaylist.png';
    public $playlist_taggable=false;

    public function render()
    {
        return view('livewire.add-playlist');
    }

    public function addPlaylistForm()
    {
        $playlist = new Playlist;
        $playlist ->name = $this->playlist_name;
        $playlist ->description = $this->playlist_description;
        $playlist ->taggable = $this->playlist_taggable;
        $playlist ->image =$this->emptyPlaylistImage;


        if($this->emptyPlaylistImage!=$this->playlist_img)
        {
            $path_playlist = 'public/playlist/img';

            //song image
            $img = $this->playlist_img->store($path_playlist);
            $img = substr($img, 6);
            $Img = "storage" . $img;

            $playlist->image = $Img;
        }


        $playlist->save();
        $this->playlists = Playlist::all();
        $this->emit('refreshPlaylist');

    }

}
