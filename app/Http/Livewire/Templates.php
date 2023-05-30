<?php

namespace App\Http\Livewire;

use App\Models\SongTag;
use App\Models\Tag;

use App\Models\Template;
use App\Models\TagTemplate;
use Livewire\Component;


class Templates extends GlobalMethods
{

    public $templates;
    public $selected_template;
    public $selected_tempalte_id;
    public $template_tags;

    protected $rules = [
        'template_name' => ['required','min:2','max:20',"unique:template,name"],
        'template_time' => ['required','min:1','max:600',],
    ];

    protected $listeners = ['addTemplateTag'];

    public $template_name;
    public $template_time;
    public $template_loops=false;


    public function render()
    {
        return view('livewire.track-templates');
    }

    public function mount()
    {

        $this->templates= Template::all();
        $this->selected_template = $this->templates->first() ?? null ;
        $this->selected_tempalte_id = $this->selected_template->id ?? null;
        $this->template_tags = $this->selected_template->templateTags()->get() ?? null;

       // dd($this->selected_template);
        //TrackTemplate::where('id',$this->selected_tempalte_id)->with('templateTags')->get();


    }

    public function createtemplate()
    {
        $this->validate($this->rules);

        $template = new Template();
        $template ->name = $this->template_name;
        $template ->loop = $this->template_loops;
        $template ->max_time = $this->template_time;

        $template->save();
        $this->templates = Template::all();

    }

    public function showTrackTemplate($id)
    {
        $this->selected_template = Template::find($id);
        $this->selected_tempalte_id = $id;
        $this->template_tags = $this->selected_template->templateTags()->get() ?? null;
    }

    public function addTemplateTag($tag_name)
    {


        $tag = Tag::where('name',$tag_name)->first()->id;
        $template_id = $this->selected_tempalte_id;

        $track_item = new TagTemplate();

        $track_item->template_id = $template_id;
        $track_item->tag_id = $tag;

        $track_item->save();
        $this->template_tags = $this->selected_template->templateTags()->get();

    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

}
