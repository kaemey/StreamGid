<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/auth', [ProfileController::class, 'auth'])->name('auth');
Route::get('/reg', [ProfileController::class, 'reg'])->name('reg');

Auth::routes();