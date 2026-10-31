<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\TopUpPackageController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\CourselController;
use App\Http\Controllers\currencyController;
use App\Http\Controllers\unitController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', function (Request $request) {return $request->user();});

    Route::get('/user', [AuthController::class, 'index'])->name('index');
    Route::put('/user/{id}', [AuthController::class, 'update'])->name('update');
    Route::delete('/user/{id}', [AuthController::class, 'destroy'])->name('destroy');

    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/currency', [currencyController::class, 'store'])->name('currency.store');
    Route::put('/currency/{id}', [currencyController::class, 'update'])->name('currency.update');
    Route::delete('/currency/{id}', [currencyController::class, 'destroy'])->name('currency.destroy');

    Route::post('/panel_coursel',[CourselController::class,'store'])->name('panel_coursel.store');
    Route::put('/panel_coursel/{id}',[CourselController::class,'update'])->name('panel_coursel.update');
    Route::delete('/panel_coursel/{id}',[CourselController::class,'destroy'])->name('panel_coursel.destroy');

    Route::post('/unit', [unitController::class, 'store'])->name('unit.store');
    Route::put('/unit/{id}', [unitController::class, 'update'])->name('unit.update');
    Route::delete('/unit/{id}', [unitController::class, 'destroy'])->name('unit.destroy');

    Route::post('/game',[GamesController::class,'store'])->name('game.store');
    Route::post('/games/check-user', [GamesController::class, 'checkUser']);
    Route::put('/game/{id}',[GamesController::class,'update'])->name('game.update');
    Route::delete('/game/{id}',[GamesController::class,'destroy'])->name('game.destroy');

    Route::post('/topupPackage', [TopUpPackageController::class, 'store'])->name('topupPackage.store');
    Route::put('/topupPackage/{id}', [TopUpPackageController::class, 'update'])->name('topupPackage.update');
    Route::delete('/topupPackage/{id}', [TopUpPackageController::class, 'destroy'])->name('topupPackage.destroy');

    Route::post('/payment_type',[PaymentTypeController::class,'store'])->name('payment_type.store');
    Route::put('/payment_type/{id}',[PaymentTypeController::class,'update'])->name('payment_type.update');
    Route::delete('/payment_type/{id}',[PaymentTypeController::class,'destroy'])->name('payment_type.destroy');

    Route::post('/verify', [PaymentsController::class, 'verifyTransaction'])->name('payments.verify');
    Route::post('/payment', [PaymentsController::class, 'storePayment'])->name('payments.store');

});

//Auth
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// currency
Route::get('/currency', [currencyController::class, 'index'])->name('currency.index');
Route::get('/currency/{id}', [currencyController::class, 'show'])->name('currency.show');

// Unit
Route::get('/unit', [unitController::class, 'index'])->name('unit.index');
Route::get('/unit/{id}', [unitController::class, 'show'])->name('unit.show');

// game
Route::get('/game',[GamesController::class,'index'])->name('game.index');
Route::get('/game/{id}',[GamesController::class,'show'])->name('game.show');

// topup Package
Route::get('/topupPackage', [TopUpPackageController::class, 'index'])->name('topupPackage.index');
Route::get('/topupPackage/{id}', [TopUpPackageController::class, 'show'])->name('topupPackage.show');

// order
Route::get('/order',[OrdersController::class,'index'])->name('order.index');

// payment
Route::get('/payments', [PaymentsController::class, 'index'])->name('payments.index');
Route::get('/checkout/{id}', [PaymentsController::class, 'checkout'])->name('payments.checkout');

//payment_type
Route::get('/payment_type',[PaymentTypeController::class,'index'])->name('payment_type.index');
Route::get('/payment_type/{id}',[PaymentTypeController::class,'show'])->name('payment_type.show');

//cursel
Route::get('/panel_coursel',[CourselController::class,'index'])->name('panel_coursel.index');
Route::get('/panel_coursel/{id}',[CourselController::class,'show'])->name('panel_coursel.show');
