<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function changeFavorite($id) {
        $favorite = Favorite::where('user_id', auth()->user()->id)->where('art_id', $id)->first();

        if($favorite){
            $favorite->delete();
        } else {            
            Favorite::create([
                'user_id'=>auth()->user()->id,
                'art_id'=>$id,
            ]);
        }
        return redirect()->back()->with('success', 'Произведение добавлено в избранное');
    }

    public function showFavorite($id){
        $user = User::findOrFail($id);
        $arts = $user->favoriteArts()->get();
        $profileBg = UserImage::where('user_id',$id)->where('position', 'фон')->first();
        $profileImage = UserImage::where('user_id',$id)->where('position', 'профиль')->first();
        return view('pages.auth.profile.variants.favorites', compact('arts', 'profileBg', 'profileImage', 'user'));
    }
}
