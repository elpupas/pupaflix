<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;






Route::get('/login-google/{provider}',function(){
    return Socialite::driver('google')->stateless()->redirect();
} );

 
Route::get('/auth/{provider}/callback',[AuthController::class,'handleGoogleCallback']);