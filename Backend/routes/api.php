<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\TopUpPackageController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// game
Route::get('/game',[GamesController::class,'index'])->name('game.index');

// topup Package
 
Route::get('/topupPackage', [TopUpPackageController::class, 'index'])->name('topupPackage.index');

// order
Route::get('/order',[OrdersController::class,'index'])->name('order.index');

// payment
Route::get('/payment',[PaymentsController::class,'index'])->name('payment.index');