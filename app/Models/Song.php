<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function songTags(): HasMany
    {
        return $this->HasMany(Tag::class);
    }
}
