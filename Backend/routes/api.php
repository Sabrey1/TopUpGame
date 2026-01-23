<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\TopUpPackageController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\CourselController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// game
Route::get('/game',[GamesController::class,'index'])->name('game.index');

// topup Package
 
Route::get('/topupPackage', [TopUpPackageController::class, 'index'])->name('topupPackage.index');

// order
Route::get('/order',[OrdersController::class,'index'])->name('order.index');

// payment-list
Route::get('/payment',[PaymentsController::class,'index'])->name('payment.index');

//payment
Route::post('/checkout/{id}', [PaymentController::class, 'checkout'])->name('checkout');
Route::get('/verify', [PaymentController::class, 'verifyForm'])->name('verify.form');
Route::post('/verify', [PaymentController::class, 'verifyTransaction'])->name('verify.transaction');
Route::get('/payments/result', [PaymentController::class, 'verifyTransaction'])->name('payments.result');


//payment_type
Route::get('/payment_type',[PaymentTypeController::class,'index'])->name('payment_type.index');


//cursel
Route::get('/panel_coursel',[CourselController::class,'index'])->name('panel_coursel.index');