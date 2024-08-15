<?php

use Illuminate\Support\Facades\Route;
Route::post('/login', [\App\Http\Controllers\ApiController::class, 'login'])->name('login');
Route::post('/register', [\App\Http\Controllers\ApiController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/transfer', [\App\Http\Controllers\ApiController::class, 'transfer'])->name('transfer');
    Route::post('/revert', [\App\Http\Controllers\ApiController::class, 'revert'])->name('revert');
    Route::get('/balance/{id}', [\App\Http\Controllers\ApiController::class, 'balance'])->name('balance');
    Route::post('/logout', [\App\Http\Controllers\ApiController::class, 'logout'])->name('logout');
});
