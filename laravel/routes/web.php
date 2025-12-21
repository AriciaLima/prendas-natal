<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GiftController;


Route::get('/', [GiftController::class, 'index']);
Route::resource('gifts', GiftController::class);
?>