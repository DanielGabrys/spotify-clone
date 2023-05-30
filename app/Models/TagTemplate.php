<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTemplate extends Model
{
    use HasFactory;

    protected $table = 'tag_template';

    protected $fillable =
        [
            'track_id',
            'tag_id',
            'song_id'
        ];
}
