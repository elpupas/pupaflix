<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;





Route::post('/register',[RegisterController::class,'store']);