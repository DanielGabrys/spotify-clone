<?php

namespace App\Http\Livewire;

use App\Models\SongTag;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Tags extends GlobalMethods
{

    public $tags;

    //form
    public $name;

    protected $listeners = ['addSongTag'];

    protected $rules = [
        'name' => ['required','min:1','max:20',],

    ];

    protected function rules_dynamic()
    {

        $name=$this->name;
        return [
            'name' => ['required','min:1','max:20',
                Rule::unique("tag")->where(function ($query) use($name) {
                    $query->where('spotify_user_id', $this->user['user_id'])->where('name', $name);
                })

            ],

        ];
    }


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
        $this->validate($this->rules_dynamic());

        $tag = new Tag();
        $tag->name = strtoupper($this->name);
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


    public function addSongTag($name,$song_id)
    {

        $tag = $this->getUserTagByName($name)->id;
        $exit = SongTag::where('song_id',$song_id)->where('tag_id',$tag)->first();

        if($exit==null)
        {
            $songTag = new SongTag();

            $songTag->tag_id = $tag->id;
            $songTag->song_id = $song_id;

            $songTag->save();
            $this->emit("refreshSongTags");
        }
    }


    public function resetValidationData()
    {
        $this-> name ='';
    }

    public function updated($property)
    {
       $this->validateOnly($property);
    }


}
