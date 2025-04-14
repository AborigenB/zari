<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtTag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function art()
    {
        return $this->belongsTo(Art::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
