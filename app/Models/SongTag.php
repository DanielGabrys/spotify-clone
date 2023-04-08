<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongTag extends Model
{
    use HasFactory;

    protected $table = 'song_tag';

    protected $fillable =
        [
            'song_id',
            'tag_id',
        ];
}
