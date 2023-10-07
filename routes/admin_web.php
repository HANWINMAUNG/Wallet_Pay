<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WalletController;
use App\Http\Controllers\Backend\AdminUserController;

Route::prefix('admin')->middleware('auth:admin_user')->group(function(){
    Route::get('/', [PageController::class, 'home'])->name('admin.home');
    Route::resource('admin-user', AdminUserController::class);
    Route::resource('user', UserController::class);
    Route::get('wallet', [WalletController::class ,'index'])->name('wallet.index');
    Route::get('wallet/add/amount', [WalletController::class,'addAmount'])->name('add.amount');
    Route::post('wallet/add/amount', [WalletController::class,'addAmountStore'])->name('add-amount.store');
    Route::get('wallet/add/remove',[WalletController::class,'removeAmount'])->name('remove.amount');
    Route::post('wallet/add/remove',[WalletController::class,'removeAmountReduce'])->name('remove.amount.requce');

});
