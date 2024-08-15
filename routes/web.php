<?php

use App\Http\Middleware\UserLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Login
Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'PostLogin'])->name('login');
// Logout
Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');
// Register
Route::get('/register', [\App\Http\Controllers\UserController::class, 'register'])->name('register');
Route::post('/register', [\App\Http\Controllers\UserController::class, 'PostRegister'])->name('register');
// User panel
Route::middleware(UserLogin::class)->prefix('user')->group(function () {
    Route::get('/', [\App\Http\Controllers\UserController::class, 'home'])->name('home');
    Route::get('/extract', [\App\Http\Controllers\TransactionsController::class, 'extract'])->name('extract');
    Route::get('/transfer', [\App\Http\Controllers\TransactionsController::class, 'transfer'])->name('transfer');
    Route::post('/transfer', [\App\Http\Controllers\TransactionsController::class, 'PostTransfer'])->name('transfer');
    Route::get('/success', [\App\Http\Controllers\TransactionsController::class, 'success'])->name('success');
    Route::get('/revert/{id}/{status}', [\App\Http\Controllers\TransactionsController::class, 'revert'])->name('revert');
});
