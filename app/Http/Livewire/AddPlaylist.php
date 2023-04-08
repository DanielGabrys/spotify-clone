<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddPlaylist extends Component
{

    use WithFileUploads;


    public $playlists;
    public $emptyPlaylistImage = 'storage/images/toFill/emptyPlaylist.png';

    // addPlaylistForm
    public $playlist_name;
    public $playlist_description;
    public $playlist_img;
    public $playlist_taggable=false;

    protected $rules = [
        'playlist_name' => ['required','min:2','max:255',"unique:playlist,name"],
        'playlist_description' => ['nullable','max:255'],
        'playlist_img' => 'nullable|image|mimes:jpeg,png',
    ];



    public function render()
    {
        return view('livewire.add-playlist');
    }

    public function addPlaylistForm()
    {
        $this->validate($this->rules);

        $playlist = new Playlist;
        $playlist ->name = $this->playlist_name;
        $playlist ->description = $this->playlist_description;
        $playlist ->taggable = $this->playlist_taggable;
        $playlist ->image =$this->emptyPlaylistImage;


        if($this->playlist_img != null)
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
        $this->resetValidationData();
        $this->emit('refreshPlaylist');

    }

    public function resetValidationData()
    {
        // addSongForm
        $this-> playlist_name ='';
        $this-> playlist_img = null;
        $this-> playlist_description = '';
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

}
