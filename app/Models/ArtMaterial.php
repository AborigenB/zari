<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtMaterial extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function art()
    {
        return $this->belongsTo(Art::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
