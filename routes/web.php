<?php

use App\Http\Controllers\ArtController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReviewController;
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
Route::post('/art/{id}/review', [ReviewController::class, 'review'])->name('art.review')->middleware('auth');
Route::put('/art/{id}/update', [ArtController::class, 'update'])->name('art.update');
Route::delete('/art{id}/delete', [ArtController::class, 'destroy'])->name('art.destroy');

Route::get('/art/{id}/changeFavorite', [FavoriteController::class,'changeFavorite'])->name('art.favorite')->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('user.reg');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('user.auth');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/painters', [AuthController::class, 'painters'])->name('painters');
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware('auth');
Route::get('/profile/{id}/favorites', [FavoriteController::class, 'showFavorite'])->name('profile.favorite')->middleware('auth');
Route::get('/profile/{id}', [AuthController::class, 'showProfile'])->name('profile.show')->middleware('auth');
Route::get('/profile/{id}/edit', [AuthController::class, 'showProfileEdit'])->name('profile.edit')->middleware('auth');
Route::get('/profile/{id}/review', [AuthController::class, 'showProfileReviews'])->name('profile.review')->middleware('auth');
Route::get('/profile/{id}/chats', [AuthController::class, 'showChats'])->name('profile.chats')->middleware('auth');

Route::get('/profile/{id}/chats', [MessageController::class, 'showChat'])->name('profile.chat')->middleware('auth');
Route::post('/profile/{id}/chats/send', [MessageController::class, 'sendMessage'])->name('message.send')->middleware('auth');

Route::get('/admin', [AuthController::class, 'showAdmin'])->name('admin')->middleware('admin');
Route::get('/admin/ban/{id}', [AuthController::class, 'ban'])->name('admin.ban')->middleware('admin');
Route::get('/admin/unban/{id}', [AuthController::class, 'unban'])->name('admin.unban')->middleware('admin');

Route::get('/review/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit')->middleware('auth');
Route::put('/review/{id}/update', [ReviewController::class, 'update'])->name('review.update')->middleware('auth');
Route::get('/review/{id}/delete', [ReviewController::class, 'delete'])->name('review.delete')->middleware('auth');
Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
Route::get('/profile/{id}/editData', [AuthController::class, 'profileEditData'])->name('profile.editData')->middleware('auth');
// Route::post('/profile/{id}/editData', [AuthController::class, 'updateProfileData'])->name('profile.updateData')->middleware(['auth']);