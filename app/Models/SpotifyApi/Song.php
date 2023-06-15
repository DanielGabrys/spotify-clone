<?php

namespace App\Models\SpotifyApi;

use App\Models\Playlist;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    use HasFactory;

    protected $table = 'song';

    protected $fillable =
        [
            'title',
            'author',
        ];

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class)->withPivot('id','position');
    }

    public function songsTags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
