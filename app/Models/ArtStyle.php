<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtStyle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function art()
    {
        return $this->belongsTo(Art::class);
    }

    public function style()
    {
        return $this->belongsTo(Style::class);
    }
}
