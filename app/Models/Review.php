<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Аксессор для totalScore
    public function getTotalScoreAttribute()
    {
        return $this->score1 + $this->score2 + $this->score3 + $this->score4 + $this->score5 + $this->score6;
    }
}
