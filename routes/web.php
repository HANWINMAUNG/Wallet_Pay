<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Frontend\NotificationController;

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
Route::post('logout' , [LoginController::class,'logout'])->name('user.logout');
//admin user auth

Route::get('admin/login',[AdminLoginController::class, 'showLoginForm'])->name('get.admin.login');
Route::post('admin/login',[AdminLoginController::class, 'login'])->name('post.admin.login');
Route::post('admin/logout',[AdminLoginController::class, 'Logout'])->name('admin.logout');
Route::post('language-switch',[LanguageController::class,'languageSwitch'])->name('language.switch');
//home
Route::middleware('auth')->group(function(){
    Route::get('/',[PageController::class, 'home'])->name('home');
    Route::get('profile',[PageController::class, 'profile'])->name('profile');
    Route::get('update-password',[PageController::class, 'updatePassword'])->name('update-password');
    Route::post('update-password',[PageController::class, 'updatePasswordStore'])->name('update-password.store');
    Route::get('wallet',[PageController::class, 'wallet'])->name('wallet');
    Route::get('transfer',[PageController::class, 'transfer'])->name('transfer');
    Route::get('transfer/confirm',[PageController::class, 'transferConfirm'])->name('transfer.confirm');
    Route::post('transfer/complete',[PageController::class, 'transferComplete'])->name('transfer.complete');
    Route::get('transaction',[PageController::class, 'transaction'])->name('transaction');
    Route::get('transaction-detail/{trx_no}',[PageController::class, 'transactionDetail'])->name('transaction-detail');
    Route::get('receive-qr',[PageController::class, 'receiveQr'])->name('receive-qr');
    Route::get('scan-and-pay',[PageController::class, 'scanAndPay'])->name('scan-and-pay');
    Route::get('scan-and-pay-form',[PageController::class, 'scanAndPayForm'])->name('scan-and-pay-form');
    Route::get('scan-and-pay-confirm',[PageController::class, 'scanAndPayConfirm'])->name('scan-and-pay-confirm');
    Route::post('scan-and-pay-complete',[PageController::class, 'scanAndPayComplete'])->name('scan-and-pay-complete');

    //notification 
    Route::get('notification',[NotificationController::class, 'index'])->name('notification');
    Route::get('notification/{id}',[NotificationController::class, 'show'])->name('notification-show');
    //ajax route
    Route::get('to-account-verify',[PageController::class, 'toAccountVerify'])->name('to-account-verify');
    Route::get('password-check',[PageController::class, 'passwordCheck'])->name('password-check');
    Route::get('/transfer-hash',[PageController::class, 'transferHash'])->name('transfer-hash');
});
