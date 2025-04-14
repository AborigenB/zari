<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function arts()
    {
        return $this->belongsToMany(Art::class, 'art_tags', 'tag_id', 'art_id');
    }
}
