<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorAuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();

// To-Do routes
Route::resource('todo', TodoController::class);
Route::get('/todo/create', [TodoController::class, 'create'])->name('todo.add');

// Two-Factor Authentication routes
Route::middleware('auth')->group(function () {
    Route::post('/2fa/send', [TwoFactorAuthController::class, 'sendCode'])->name('2fa.send');
    Route::post('/2fa/verify', [TwoFactorAuthController::class, 'verifyCode'])->name('2fa.verify');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/roles', [App\Http\Controllers\AdminController::class, 'roles'])->name('admin.roles');
});
