<?php

use App\Http\Controllers\ArtController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QuestionController;
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

Route::get('/', [ArtController::class, 'index'])->name('home');

Route::middleware('checkUserStatus')->group(function () {

    Route::get('/catalog', [ArtController::class, 'catalog'])->name('catalog');
    Route::get('/art/create', [ArtController::class, 'create'])->name('art.create');
    Route::get('/art/{id}', [ArtController::class, 'show'])->name('art.show');
    Route::get('/art/{id}/like', [ArtController::class, 'likeArt'])->name('art.like');
    Route::get('/art/{id}/edit', [ArtController::class, 'edit'])->name('art.edit');
    Route::post('/art', [ArtController::class, 'store'])->name('art.store');
    Route::post('/art/{id}/review', [ReviewController::class, 'review'])->name('art.review')->middleware('auth');
    Route::put('/art/{id}/update', [ArtController::class, 'update'])->name('art.update');
    Route::get('/art/{id}/delete', [ArtController::class, 'destroy'])->name('art.destroy');
    Route::get('/art/{id}/accept', [AuthController::class, 'acceptArt'])->name('art.accept')->middleware('admin');

    // Избранное
    Route::get('/art/{id}/changeFavorite', [FavoriteController::class, 'changeFavorite'])->name('art.favorite')->middleware('auth');

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
    Route::get('/profile/{id}/socials', [AuthController::class, 'showSocials'])->name('profile.socials')->middleware('auth');

    // Корзина
    Route::post('/art/{id}/addToBasket', [BasketController::class, 'addToBasket'])->name('art.addToBasket')->middleware('auth');
    Route::post('/art/{id}/removeFromBasket', [BasketController::class, 'removeFromBasket'])->name('art.removeFromBasket')->middleware('auth');
    Route::get('/profile/{id}/basket', [AuthController::class, 'showBasket'])->name('profile.basket')->middleware('auth');

    // Маршрут для отправки вопроса
    Route::post('/send-question', [QuestionController::class, 'store'])->name('send.question');

    // Маршрут для отображения вопросов в админ панели
    Route::get('/admin/questions', [QuestionController::class, 'index'])->name('admin.questions');
    Route::get('/admin/questions/{id}/accept', [QuestionController::class, 'accept'])->name('admin.questions.accept');
    Route::get('/admin/questions/{id}/close', [QuestionController::class, 'close'])->name('admin.questions.close');
    Route::get('/admin/questions/{id}/delete', [QuestionController::class, 'destroy'])->name('admin.questions.delete');

    // Заказы
    Route::get('/profile/{id}/orders', [AuthController::class, 'showOrders'])->name('profile.orders')->middleware('auth');
    Route::get('/profile/{id}/order/create', [OrderController::class, 'create'])->name('order.create')->middleware('auth');
    Route::get('/profile/{id}/order/store', [OrderController::class, 'store'])->name('order.store')->middleware('auth');

    Route::get('/profile/{id}/chat', [MessageController::class, 'showChat'])->name('profile.chat')->middleware('auth');
    Route::post('/profile/{id}/chats/send', [MessageController::class, 'sendMessage'])->name('message.send')->middleware('auth');
    Route::get('/profile/{id}/chats', [MessageController::class, 'showChats'])->name('profile.chats')->middleware('auth');

    Route::get('/admin', [AuthController::class, 'showAdmin'])->name('admin')->middleware('admin');
    Route::get('/admin/ban/{id}', [AuthController::class, 'ban'])->name('admin.ban')->middleware('admin');
    Route::get('/admin/unban/{id}', [AuthController::class, 'unban'])->name('admin.unban')->middleware('admin');
    Route::put('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    Route::get('/review/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit')->middleware('auth');
    Route::put('/review/{id}/update', [ReviewController::class, 'update'])->name('review.update')->middleware('auth');
    Route::get('/review/{id}/delete', [ReviewController::class, 'delete'])->name('review.delete')->middleware('auth');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
    Route::get('/profile/{id}/editData', [AuthController::class, 'profileEditData'])->name('profile.editData')->middleware('auth');
    // Route::post('/profile/{id}/editData', [AuthController::class, 'updateProfileData'])->name('profile.updateData')->middleware(['auth']);

});
