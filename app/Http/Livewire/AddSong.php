<?php

namespace App\Http\Livewire;

use App\Models\Song;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use wapmorgan\Mp3Info\Mp3Info;

class AddSong extends CenterContent
{

    use WithFileUploads;

    public $songs;
    public $songs_json;

    // addSongForm
    public $title;
    public $author;
    public $img;
    public $songSrc;
    public $emptySongImage = 'storage/images/toFill/playlist.png';

    protected $rules = [
        'title' => ['required','min:2','max:255'],
        'author' => ['min:2','max:255'],
        'img' => 'nullable|image|mimes:jpeg,png',
        'songSrc' => ['required','mimes:mp3','max:10000'],

    ];


    //songs
    public function songs()
    {
        // $this->content = '<h4> vfsdcds </h4> </div>';

        $this->allSongs = Song::all();
        $this->songs_json = $this->allSongs->toJson();
        $this->subView = "livewire.song-menu";


    }

    public function addSongForm()
    {
        $this->validate($this->rules);



        $song = new Song();
        $song->title = $this->title;
        $song->author = $this->author;
        $song->image =$this->emptySongImage;

        $path_music = 'public/music';
        $path_image = 'public/images/songs';


        $Img ='';
        if($this->img != null)
        {

            //song image
            $img= $this->img->store($path_image);
            $img = substr($img,6);
            $Img= "storage".$img;

            $song->image = $Img;
        }

        //song track
        $scr = $this->songSrc->store($path_music);
        $scr = substr($scr, 6);
        $src = "storage" . $scr;

        $song->src = $src;


        $audio = new Mp3Info($src);

        // $song->duration = $this->calculateTime($audio->duration);
        $song->duration = $audio->duration;
        $song->save();

        // $this->resetValidationData();

        $this->songs();

    }

    public function deleteSong($id)
    {
        $song = Song::where('id',$id);
        $songData = $song->get()->first();


        Storage::delete($songData->image);
        Storage::delete($songData->src);

        $song->delete();
        $this->songs();
    }




    public function render()
    {
        return view('livewire.add-song');
    }

    public function resetValidationData()
    {
        // addSongForm
        $this-> title ='';
        $this-> author ='';
        $this-> img = $this->emptySongImage;
        $this-> songSrc = '';
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }


}
