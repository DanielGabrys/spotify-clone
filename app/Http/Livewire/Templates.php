<?php

namespace App\Http\Livewire;


use App\Models\Playlist;
use App\Models\SpotifyApi\SpotifyApi;
use App\Models\Tag;
use App\Models\TagTemplate;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


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
    public $template_playlist_export;

    public function render()
    {
        return view('livewire.track-templates');
    }


    public function mount()
    {

        $this->uniqueRule = "unique:template,name,".$this->selected_tempalte_id;
        $this->templates= $this->getUserTemplates();
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
        $template->spotify_user_id = $this->user['user_id'];

        $template->save();

        $this->selected_template = Template::find($template->id);
        $this->selected_tempalte_id = $this->selected_template->id;
        $this->template_tags = $this->selected_template->templateTags()->get();


        $this->templates = $this->getUserTemplates();

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


        $this->templates = $this->getUserTemplates();


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


        $tag = $this->getUserTagByName($tag_name)->id;
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
        $this->templates = $this->getUserTemplates();

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
        $spotify_playlist_songs_ids = [];

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
                        array_push($spotify_playlist_songs_ids, $tag['songs_tags'][$rand]['spotify_track_id'] ?? null);


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

        // not eksport to spotify
        if(!$this->template_playlist_export)
            return '';

        // eksport to spotify
        $uris = $this->normalizeSpotifyPlaylistTracksIds($spotify_playlist_songs_ids);
        $this->storePlaylistWithSongsInSpotify($uris);

       // dd($selected_songs,$ordered_tags,$this->calculateTime($time),$max_time);

        return $uris;
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
                $playlist ->image =$this->emptyPlaylistImage;
                $playlist->spotify_user_id = $this->user['user_id'];

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

    public function normalizeSpotifyPlaylistTracksIds($tracks)
    {
        $array = array();

        for($i=0;$i<count($tracks);$i++)
        {
            $uris ="spotify:track:".$tracks[$i];
            array_push($array,$uris);
        }

        $array = json_encode( array('uris' => $array));
        //dd($array);

        return $array;

    }

    public function storePlaylistWithSongsInSpotify($uris)
    {

        //add playlist to spotify
        $data = array(
            'name' => $this->template_playlist_name,
            'description' => "Template Tag Playlist",
        );

        $json = json_encode($data);
        $spotify_playlist = SpotifyApi::storePlaylist($this->user,$json);
        SpotifyApi::storePlaylistItems($spotify_playlist['id'],$uris);




    }

}
