<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Auth::routes();