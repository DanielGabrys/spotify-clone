<?php

namespace App\Http\Livewire;

use App\Models\Song;
use App\Models\Tag;
use Livewire\Component;

class Tags extends Component
{

    public $tags;

    //form
    public $tag_name;

    protected $rules = [
        'tag_name' => ['required','min:1','max:20',"unique:tag,name"],
    ];

    public function mount()
    {

        $this->tags= Tag::all()->whereNotIn('name','-');
    }

    public function render()
    {
        return view('livewire.tags');
    }


    public function addTag()
    {
        $this->validate($this->rules);

        $tag = new Tag();
        $tag->name = $this->tag_name;
        $tag->save();

        $this->tags= Tag::all()->whereNotIn('name','-');
        $this->resetValidationData();
    }

    public function deleteTag($id)
    {
        Tag::find($id)->delete();
        $this->tags= Tag::all()->whereNotIn('name','-');
        $this->emit('refreshTag');
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
