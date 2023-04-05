<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Playlist extends Model
{
    use HasFactory;

    protected $table = 'playlist';

    protected $fillable =
        [
            'name',
            'description',
        ];

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class)->withPivot('id','position');
    }
}
