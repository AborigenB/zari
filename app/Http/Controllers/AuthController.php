<?php

namespace App\Http\Controllers;

use App\Models\Art;
use App\Models\Review;
use App\Models\Social;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        // dd('user'.uniqid());
        $request->validate([
            // 'login' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'login' => 'user' . uniqid(),
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home')); // Замените на нужный маршрут
        }

        return back()->withErrors([
            'login' => 'Неверный логин или пароль',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showProfile($id)
    {
        $user = User::findOrFail($id);
       
        $arts = Art::where('user_id',$id)->get();
        return view('pages.auth.profile.variants.works', compact('user', 'arts'));
    }

    public function showProfileEdit($id)
    {
        $user = User::findOrFail($id);
        
        $social_vk = Social::where('user_id',auth()->user()->id)->where('social','vk')->first();
        $social_tg = Social::where('user_id',auth()->user()->id)->where('social','telegram')->first();
        $social_yt = Social::where('user_id',auth()->user()->id)->where('social','youtube')->first();

        return view('pages.auth.profile.crud.edit', compact( 'social_vk', 'social_tg', 'social_yt'));
    }

    public function showProfileReviews($userId){
        $user = User::findOrFail($userId);

        $reviews = $user->reviews()->get();
        // dd($reviews);
        return view('pages.auth.profile.variants.reviews', compact('user', 'reviews'));
    }

    public function painters(){
        // Вывести всех пользователей, которые создали публикацию в таблицу arts
        $users = User::has('arts')->get();  
        return view('pages.auth.profile.variants.painters', compact('users'));
    }
    
    public function profileEditData(){
        $user = Auth::user();
        return view('pages.auth.profile.crud.uchetka.index', compact('user'));
    }

    public function showChats($id){
        $user = User::findOrFail($id);
        return view('pages.auth.profile.variants.chats', compact('user'));
    }
    
    public function showAdmin(){
        $users = User::all();
        $arts = Art::all();
        $reviews = Review::all();
        return view('pages.admin.index', compact('users', 'arts', 'reviews'));
    }

    public function ban($id){
        $user = User::findOrFail($id);
        $user->role = 'banned';
        $user->save();
        return redirect()->back();
    }
    public function unban($id){
        $user = User::findOrFail($id);
        $user->role = 'user';
        $user->save();
        return redirect()->back();
    }
    
    public function updateProfile(Request $request)
    {
        // Валидация запроса
        $request->validate([
            'login'=>'required|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string|max:255',
            'social_vk'=>'nullable|string|max:255',
            'social_tg'=>'nullable|string|max:255',
            'social_yt'=>'nullable|string|max:255',
        ]);

        // $user = Auth::user();
        $user = User::find(auth()->user()->id);

        // Обработка изображения профиля
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');

            // Найти или создать запись для изображения профиля
            $profileImage = UserImage::firstOrNew(['user_id' => $user->id, 'position' => 'профиль']);
            
            if ($profileImage->url && Storage::disk('public')->exists($profileImage->url)) {
                Storage::disk('public')->delete('/'.$profileImage->url);
                
            }
            $profileImage->url = $profileImagePath;
            $profileImage->save();

            return response()->json([
                'success' => true,
                'profile_image_path' => asset('storage/' . $profileImagePath),    
            ]);
        }

        // Обработка фонового изображения
        if ($request->hasFile('background_image')) {
            $backgroundImagePath = $request->file('background_image')->store('profile_images', 'public');

            // Найти или создать запись для фонового изображения
            $backgroundImage = UserImage::firstOrNew(['user_id' => $user->id, 'position' => 'фон']);
            if ($backgroundImage->url && Storage::disk('public')->exists($backgroundImage->url)) {
                Storage::disk('public')->delete('/'.$backgroundImage->url);
            }
            $backgroundImage->url = $backgroundImagePath;
            $backgroundImage->save();
            return response()->json([
                'success' => true,
                'background_image_path' => asset('storage/' . $backgroundImagePath),
            ]);
        }

        // Обновление других данных пользователя
        if ($request->filled('description')) {
            $user->description = $request->description;
            $user->save();
        }
        if ($request->filled('login')) {
            $user->login = $request->login;
            $user->save();
        }
        if ($request->filled('social_vk')) {
            $social = Social::firstOrNew(['user_id'=>$user->id,'social' => 'vk']);
            if($social->link){
                $social->link = $request->social_vk;
                $social->save();
            } else{
                Social::create([
                    'user_id'=>$user->id,
                    'social'=>'vk',
                    'link'=>$request->social_vk,
                ]);
            }
        }
        if ($request->filled('social_tg')) {
            $social = Social::firstOrNew(['user_id'=>$user->id,'social' => 'telegram']);
            if($social->link){
                $social->link = $request->social_tg;
                $social->save();
            } else{
                Social::create([
                    'user_id'=>$user->id,
                    'social'=>'telegram',
                    'link'=>$request->social_tg,
                ]);
            }
        }
        if ($request->filled('social_yt')) {
            $social = Social::firstOrNew(['user_id'=>$user->id,'social' => 'youtube']);
            if($social->link){
                $social->link = $request->social_yt;
                $social->save();
            } else{
                Social::create([
                    'user_id'=>$user->id,
                    'social'=>'youtube',
                    'link'=>$request->social_yt,
                ]);
            }
        }
       
        
        return redirect()->route('profile.show', auth()->user()->id);
    }
}
