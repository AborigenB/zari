<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(ArtImages::class);
    }
    public function materials()
    {
        return $this->belongsToMany(Material::class, 'art_materials', 'art_id', 'material_id');
    }

    public function styles()
    {
        return $this->belongsToMany(Style::class, 'art_styles', 'art_id', 'style_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'art_tags', 'art_id', 'tag_id');
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function isFavorite(){
        if(auth()->check()){
            return $this->favorites()->where('user_id', auth()->user()->id)->exists();
        } 
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }

    // public function likes()
    // {
    //     return $this->hasMany(Like::class);
    // }

    // public function dislikes()
    // {
    //     return $this->hasMany(Dislike::class);
    // }

    // public function views()
    // {
    //     return $this->hasMany(View::class);
    // }

    // public function shares()
    // {
    //     return $this->hasMany(Share::class);
    // }

    
}
