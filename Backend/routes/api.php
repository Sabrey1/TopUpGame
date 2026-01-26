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

// payment
Route::get('/payments', [PaymentsController::class, 'index'])->name('payments.index');
Route::get('/checkout/{id}', [PaymentsController::class, 'checkout'])->name('payments.checkout');
Route::post('/verify', [PaymentsController::class, 'verifyTransaction'])->name('payments.verify');
Route::post('/payment', [PaymentsController::class, 'storePayment'])->name('payments.store');

//payment_type
Route::get('/payment_type',[PaymentTypeController::class,'index'])->name('payment_type.index');

//cursel
Route::get('/panel_coursel',[CourselController::class,'index'])->name('panel_coursel.index');
Route::get('/panel_coursel/{id}',[CourselController::class,'show'])->name('panel_coursel.show');
Route::post('/panel_coursel',[CourselController::class,'store'])->name('panel_coursel.store');
Route::put('/panel_coursel/{id}',[CourselController::class,'update'])->name('panel_coursel.update');
Route::delete('/panel_coursel/{id}',[CourselController::class,'destroy'])->name('panel_coursel.destroy');
