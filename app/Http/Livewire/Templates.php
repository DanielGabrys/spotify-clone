<?php

namespace App\Http\Livewire;


use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use App\Models\SongTag;
use App\Models\Tag;

use App\Models\Template;
use App\Models\TagTemplate;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;



class Templates extends GlobalMethods
{


    public $templates;
    public $selected_template;
    public $selected_tempalte_id;
    public $template_tags;

    public $uniqueRule;

    public $emptyPlaylistImage = 'storage/images/toFill/template_playlist.png';



    protected $rules = [
        'template_name' => [ 'required','min:2','max:20',"unique:template,name"],
        'template_time' => ['required','integer','min:1','max:600',],
    ];

    protected $rules_generated_playlist = [
        'template_playlist_name' => [ 'required','min:2','max:20',"unique:playlist,name"],
    ];

    protected function rules_edit()
    {
        return
        [
            'template_name_edit' => [ 'required','min:2','max:20','unique:template,name,'.$this->selected_tempalte_id],
            'template_time_edit' => ['required','integer','min:1','max:600',],
        ];
    }


    protected $listeners = ['addTemplateTag'];

    public $template_name;
    public $template_time;
    public $template_loops=false;

    public $template_name_edit;
    public $template_time_edit;
    public $template_loops_edit=false;

    public $template_playlist_name;

    public function render()
    {
        return view('livewire.track-templates');
    }


    public function mount()
    {

        $this->uniqueRule = "unique:template,name,".$this->selected_tempalte_id;
        $this->templates= Template::all();
        $this->selected_template = $this->templates->first() ?? null;
        $this->selected_tempalte_id = $this->selected_template->id ?? null;

        if($this->selected_template)
            $this->template_tags = $this->selected_template->templateTags()->get();

        $this->setTemplateEditFormValues();

    }

    public function setTemplateEditFormValues()
    {

        if($this->templates->count()>0)
        {
            $this->template_name_edit = $this->selected_template->name;
            $this->template_time_edit = $this->selected_template->max_time;
            $this->template_loops_edit = $this->selected_template->loop;

        }
    }

    public function createTemplate()
    {
        $this->validate($this->rules);

        $template = new Template();
        $template ->name = $this->template_name;
        $template ->loop = $this->template_loops;
        $template ->max_time = $this->template_time;

        $template->save();
        $this->selected_template = Template::find($template->id);
        $this->selected_tempalte_id = $this->selected_template->id;
        $this->template_tags = $this->selected_template->templateTags()->get();


        $this->templates = Template::all();

        $this->setTemplateEditFormValues();

    }

    public function editTemplate()
    {


        $this->validate($this->rules_edit());

        $template = Template::find($this->selected_tempalte_id);
        $template ->name = $this->template_name_edit;
        $template ->loop = $this->template_loops_edit;
        $template ->max_time = $this->template_time_edit;

        $template->save();

        $this->selected_template = Template::find($template->id);
        $this->selected_tempalte_id = $this->selected_template->id;
        $this->template_tags = $this->selected_template->templateTags()->get();


        $this->templates = Template::all();


    }



    public function showTrackTemplate($id)
    {
        $this->selected_template = Template::find($id);
        $this->selected_tempalte_id = $id;
        $this->template_tags = $this->selected_template->templateTags()->get() ?? null;

         $this->setTemplateEditFormValues();
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

    public function deleteTemplateTag($id)
    {

        TagTemplate::find($id)->delete();
        $this->template_tags = $this->selected_template->templateTags()->get();

    }

    public function deleteTemplate($id)
    {


        Template::where('id',$id)->delete();
        $this->templates = Template::all();

        if($this->selected_tempalte_id==$id)
        {
            $this->selected_template = $this->templates->first() ?? null ;
            $this->selected_tempalte_id = $this->selected_template->id ?? null;

            if($this->selected_template)
                $this->template_tags = $this->selected_template->templateTags()->get() ?? null;

            $this->setTemplateEditFormValues();

        }


    }


    public function generateTemplatePlaylist()
    {

        $selected_songs =[];
        $time =0;
        $max_time = $this->selected_template->max_time*60;

        $tag_ids = TagTemplate::where('template_id',$this->selected_tempalte_id)->orderBy('id')->get()->pluck('tag_id');
        $songs = Tag::with('songsTags')->whereIn('id',$tag_ids)->get()->toArray();


        $ordered_tags =[];


        // set tags in correct order
        foreach($tag_ids as $tag )
        {
            $key = array_search($tag, array_column($songs, 'id'));
            array_push($ordered_tags, $songs[$key]);

        }

        while($time<$max_time && count($ordered_tags)>0)
        {
                $index = 0;
                foreach ($ordered_tags as $tag)
                {

                    if (count($tag['songs_tags']) > 0)
                    {
                        $rand = array_rand($tag['songs_tags'], 1);

                        $time += $tag['songs_tags'][$rand]['duration'];

                        if($time>$max_time)
                            break;

                        array_push($selected_songs, $tag['songs_tags'][$rand]['id'] ?? null);

                        unset($ordered_tags[$index]['songs_tags'][$rand]);
                    }
                    else
                    {
                        unset($ordered_tags[$index]);
                    }

                    $index++;


                }

                if(!$this->selected_template->loop)
                    break;

        }


        $this->templatePlaylistToDatabase($selected_songs);
       // dd($selected_songs,$ordered_tags,$this->calculateTime($time),$max_time);

    }

    public function templatePlaylistToDatabase($songs)
        {

            $this->validate($this->rules_generated_playlist);
            DB::beginTransaction();

            try
            {

                $playlist = new Playlist;
                $playlist ->name = $this->template_playlist_name;
                $playlist ->description = Carbon::now()->toDateString();
                $playlist ->taggable = 0;
                $playlist ->image =$this->emptyPlaylistImage;

                $playlist->save();

                foreach ($songs as $song)
                {
                    $this->addSongToPlaylist($song,$playlist->id);

                }

                $this->emit('refreshPlaylist');

                DB::commit();
            }
            catch (\Exception $e)
            {
                dd($e);
                DB::rollBack();
            }

        }


    public function updated($property)
    {

        $this->validateOnly($property);

    }

}
