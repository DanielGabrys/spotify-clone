<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';

    protected $fillable =
        [
            'name',
            'spotify_user_id'
        ];

    public function songsTags(): BelongsToMany
    {
        return $this->belongsToMany(Song::class)->withPivot('id');
    }

    public function templateTags(): BelongsToMany
    {
        return $this->belongsToMany(Template::class);
    }

    public function songsTemplate() : HasManyThrough
    {
        return $this->hasManyThrough(Song::class,Template::class);
    }


}
