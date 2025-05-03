<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

Route::get('user-home', [UserController::class,'userHome']);
Route::get('tops', [UserController::class,'tops']);
Route::get('bottoms', [UserController::class,'bottoms']);
Route::get('bags-n-accessories', [UserController::class,'bna']);
Route::get('cargo-pants', [UserController::class,'bottoms']);
Route::get('hats', [UserController::class,'bna']);
Route::get('footwear', [UserController::class,'footwear']);

Route::get('admin-login', [UserController::class,'adminLogin']);

Route::get('login', [UserController::class,'login']);
Route::get('signup', [UserController::class,'signup']);