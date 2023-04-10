<?php

namespace App\Http\Livewire;

use App\Models\Song;
use App\Models\SongTag;
use App\Models\Tag;
use Livewire\Component;

class GlobalMethods extends Component
{

    public $tags;
    public function render()
    {
        return view('livewire.global-methods');
    }

    public function setTags()
    {

        $tags = [];

        foreach ($this->songs as $song)
        {

            $tag = $this->getSongTags($song->id);
            $tags += [$song->id => $tag];

        }

        return $tags;
    }

    function getSongTags($id)
    {
        $song = Song::find($id);
        $tags = $song->songsTags()->whereNot('name','-')->get();

        return $tags;
    }

    public function calculateTime($sec)
    {
        $minutes = floor($sec / 60);
        $seconds = floor($sec % 60);
        $returnSec = $seconds < 10 ? '0'.$seconds:$seconds;
        return $minutes.':'.$returnSec;

    }

    public function deleteTagFromSong($song_id,$tag_id)
    {

        if(Tag::find($tag_id)->name!="-")
        {
            SongTag::where('song_id', $song_id)->where('tag_id', $tag_id)->delete();
            $this->tags = $this->setTags();
        }
    }
}
