<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/form/{id}', [FormController::class, 'index'])->name('form');

Route::get('/form/order/{id}', [FormController::class, 'order'])->name('orderStream');
Route::get('/order/success', [FormController::class, 'orderSuccess'])->name('orderSuccess');
Route::post('/form/order', [FormController::class, 'sendOrder'])->name('sendOrder');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile', [ProfileController::class, 'upload_avatar'])->name('upload_avatar');

Route::get('/auth', [ProfileController::class, 'auth'])->name('auth');
Route::get('/reg', [ProfileController::class, 'reg'])->name('reg');

Auth::routes();