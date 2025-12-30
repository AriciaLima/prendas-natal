<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GiftController::class, 'index']);
Route::resource('gifts', GiftController::class);
Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'destroy']);
