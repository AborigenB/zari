<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function arts()
    {
        return $this->belongsToMany(Art::class, 'art_styles', 'style_id', 'art_id');
    }
}
