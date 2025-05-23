<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorAuthController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('todo', TodoController::class);
Route::get('/todo/create', [App\Http\Controllers\TodoController::class, 'create'])->name('todo.add');

Route::middleware('auth')->group(function () {
    Route::post('/2fa/send', [TwoFactorAuthController::class, 'sendCode'])->name('2fa.send');
    Route::post('/2fa/verify', [TwoFactorAuthController::class, 'verifyCode'])->name('2fa.verify');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});