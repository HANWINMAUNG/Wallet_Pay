<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Auth\AdminLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//user auth
Auth::routes();
//admin user auth
Route::get('/',[PageController::class, 'home'])->name('home');
Route::get('admin/login',[AdminLoginController::class, 'showLoginForm'])->name('get.admin.login');
Route::post('admin/login',[AdminLoginController::class, 'login'])->name('post.admin.login');
Route::post('admin/logout',[AdminLoginController::class, 'logout'])->name('admin.logout');
//home
Route::get('admin', function(){
    return "adminpage";
});