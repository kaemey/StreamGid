<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/form/{id}', [FormController::class, 'index'])->name('form');

Route::get('/form/order/{id}', [FormController::class, 'order'])->name('orderStream');
Route::get('/order/success', [FormController::class, 'orderSuccess'])->name('orderSuccess');
Route::post('/form/order', [OrderController::class, 'sendOrder'])->name('sendOrder');

Route::get('/order/list', action: [OrderController::class, 'orderList'])->name('orderList');
Route::get('/order/accept/{id}', action: [OrderController::class, 'acceptOrder'])->name('acceptOrder');
Route::get('/order/cancel/{id}', action: [OrderController::class, 'cancelOrder'])->name('cancelOrder');
Route::get('/order/pay_order/{id}', action: [OrderController::class, 'payOrder'])->name('payOrder');
Route::get('/order/finishOrder/{id}', action: [OrderController::class, 'finishOrder'])->name('finishOrder');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile', [ProfileController::class, 'upload_avatar'])->name('upload_avatar');

Route::get('/auth', [ProfileController::class, 'auth'])->name('auth');
Route::get('/reg', [ProfileController::class, 'reg'])->name('reg');

Route::get('/chats', [ChatController::class, 'index'])->name('chat_index');
Route::get('/chats/{id}', [ChatController::class, 'show'])->name('chat_show');
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');

Auth::routes();