<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Template extends Model
{
    use HasFactory;

    protected $table = 'template';

    protected $fillable =
        [
            'name',
            'loop_number',
            'max_time'
        ];

    public function templateTags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'tag_template',)->withPivot('id');
    }
}

