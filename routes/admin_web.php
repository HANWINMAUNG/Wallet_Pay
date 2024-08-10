<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WalletController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\TransactionController;

Route::prefix('admin')->middleware('auth:admin_user')->group(function(){
    Route::get('/', [PageController::class, 'home'])->name('admin.home');
    Route::resource('admin-user', AdminUserController::class);
    Route::resource('user', UserController::class);
    Route::resource('transaction', TransactionController::class);
    Route::get('wallet', [WalletController::class ,'index'])->name('wallet.index');
    Route::get('wallet/add-amount', [WalletController::class,'addAmount'])->name('add.amount');
    Route::post('wallet/add-amount/create', [WalletController::class,'addAmountStore'])->name('add-amount.store');
    Route::get('wallet/remove-amount',[WalletController::class,'removeAmount'])->name('remove.amount');
    Route::post('wallet/remove-amount/update',[WalletController::class,'removeAmountReduce'])->name('remove.amount.reduce');

});
