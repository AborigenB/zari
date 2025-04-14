<?php

use App\Http\Controllers\ArtController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ArtController::class,'index'])->name('home');

Route::get('/catalog', [ArtController::class, 'catalog'])->name('catalog');
Route::get('/art/create', [ArtController::class, 'create'])->name('art.create');
Route::get('/art/{id}', [ArtController::class,'show'])->name('art.show');
Route::get('/art/{id}/like', [ArtController::class,'likeArt'])->name('art.like');
Route::get('/art/{id}/edit', [ArtController::class,'edit'])->name('art.edit');
Route::post('/art', [ArtController::class, 'store'])->name('art.store');
Route::put('/art/{id}', [ArtController::class, 'update'])->name('art.update');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('user.reg');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('user.auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware('auth');
Route::get('/profile/{id}', [AuthController::class, 'showProfile'])->name('profile.show')->middleware('auth');
Route::get('/profile/edit', [AuthController::class, 'showProfileEdit'])->name('profile.edit')->middleware('auth');
Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update')->middleware('auth');