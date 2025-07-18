<?php

//Кастомный Middleware - замена 'auth'
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/form/{id}', [FormController::class, 'index'])->name('form');

Route::middleware('guest')->group(function () {
    Route::get('/auth', [ProfileController::class, 'auth'])->name('auth');
    Route::get('/reg', [ProfileController::class, 'reg'])->name('reg');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'upload_avatar'])->name('upload_avatar');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/form/order/{id}', [FormController::class, 'order'])->name('orderStream');
    Route::get('/order/success', [FormController::class, 'orderSuccess'])->name('orderSuccess');
    Route::post('/form/order', [OrderController::class, 'sendOrder'])->name('sendOrder');

    Route::get('/order/list', action: [OrderController::class, 'orderList'])->name('orderList');
    Route::get('/order/accept/{id}', action: [OrderController::class, 'acceptOrder'])->name('acceptOrder');
    Route::get('/order/cancel/{id}', action: [OrderController::class, 'cancelOrder'])->name('cancelOrder');
    Route::get('/order/pay_order/{id}', action: [OrderController::class, 'payOrder'])->name('payOrder');
    Route::get('/order/payment_success/{id}', action: [OrderController::class, 'paymentSuccess'])->name('paymentSuccess');
    Route::get('/order/payment_fail/{id}', action: [OrderController::class, 'paymentFail'])->name('paymentFail');
    Route::get('/order/finishOrder/{id}', action: [OrderController::class, 'finishOrder'])->name('finishOrder');
    Route::post('/order/sendReviewPoint/{id}', action: [OrderController::class, 'sendReviewPoint'])->name('sendReviewPoint');

    Route::get('/chats', [ChatController::class, 'index'])->name('chat_index');
    Route::get('/chats/{id}', [ChatController::class, 'show'])->name('chat_show');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});
