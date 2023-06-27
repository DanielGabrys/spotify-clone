<?php

namespace App\Http\Livewire;

use App\Models\SongTag;
use App\Models\Tag;
use Livewire\Component;

class Tags extends GlobalMethods
{

    public $tags;

    //form
    public $tag_name;

    protected $listeners = ['addSongTag'];

    protected $rules = [
        'tag_name' => ['required','min:1','max:20',"unique:tag,name"],

    ];

    public function mount()
    {

        $this->tags= $this->getUserTags();
    }

    public function render()
    {
        return view('livewire.tags');
    }


    public function addTag()
    {
        $this->validate($this->rules);

        $tag = new Tag();
        $tag->name = strtoupper($this->tag_name);
        $tag->spotify_user_id = $this->user['user_id'];
        $tag->save();

        $this->tags= $this->getUserTags();
        $this->resetValidationData();
    }

    public function deleteTag($id)
    {
        Tag::find($id)->delete();
        $this->tags= $this->getUserTags();
        $this->emit('refreshTag');

    }


    public function addSongTag($tag_name,$song_id)
    {

        $tag = Tag::where('spotify_user_id',$this->user['user_id'])->where('name',$tag_name)->first()->id;
        $exit = SongTag::where('song_id',$song_id)->where('tag_id',$tag)->first();

        if($exit==null)
        {
            $songTag = new SongTag();

            $songTag->tag_id = $tag;
            $songTag->song_id = $song_id;

            $songTag->save();
            $this->emit("refreshSongTags");
        }
    }


    public function resetValidationData()
    {
        $this-> tag_name ='';
    }

    public function updated($property)
    {
       $this->validateOnly($property);
    }


}
