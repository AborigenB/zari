<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [ ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function images()
    {
        return $this->hasMany(UserImage::class);
    }
    
    public function favorites(){
        return $this->hasMany(Favorite::class);
    }
    
    public function favoriteArts(){
        // получение многие к многим
        return $this->belongsToMany(Art::class, 'favorites', 'user_id', 'art_id');
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function arts(){
        return $this->hasMany(Art::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
    
    public function profileImage(){
        // Проверка на существование 
        if($this->images()->where('position', 'профиль')->exists()){
            return $this->images()->where('position', 'профиль')->first()->url;
        } else {
            return 'profile_images/RCbh8ncI5lss9UiRDPavEn2nj1MhxZMMj5LP7KaU.png';
        }
    }
    public function profileBgImage(){
        // Проверка на существование 
        if($this->images()->where('position', 'фон')->exists()){
            return $this->images()->where('position', 'фон')->first()->url;
        } else {
            return 'profile_images/RCbh8ncI5lss9UiRDPavEn2nj1MhxZMMj5LP7KaU.png';
        }
    }
}
