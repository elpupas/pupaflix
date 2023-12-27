<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/register', [RegisterController::class, 'store'])->name('user.register');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');
    Route::put('user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}/delete', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('user/{id}/show', [UserController::class, 'show'])->name('user.show');

});
