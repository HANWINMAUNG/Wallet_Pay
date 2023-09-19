<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\AdminUserController;

Route::prefix('admin')->middleware('auth:admin_user')->group(function(){
    Route::get('/', [PageController::class, 'home'])->name('admin.home');
    Route::rosource('admin-user',AdminUserController::class);
});
