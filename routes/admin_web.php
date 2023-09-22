<?php

use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\AdminUserController;

Route::prefix('admin')->middleware('auth:admin_user')->group(function(){
    Route::get('/', [PageController::class, 'home'])->name('admin.home');
    Route::resource('admin-user', AdminUserController::class);
    Route::resource('user', UserController::class);
});
