<?php

namespace App\Models;

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
}
