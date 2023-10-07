<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 Route::post('/register',[RegisterController::class, 'register']);
 Route::post('/login',[LoginController::class, 'login']);
 Route::middleware('auth:api')->group(function(){
    Route::get('/profile',[PageController::class, 'profile']);
    Route::post('/logout',[LoginController::class, 'logout']);

    Route::get('/transaction',[PageController::class, 'transaction']);
    Route::get('/transaction/{trx_no}',[PageController::class, 'transactionDetail']);

    Route::get('/notification',[PageController::class, 'notification']);
    Route::get('/notification/{id}',[PageController::class, 'notificationDetail']);

    Route::get('/to-account-verify',[PageController::class, 'toAccountVerify']);
    Route::get('/transfer-confirm',[PageController::class, 'transferConfirm']);
    Route::post('/transfer-complete',[PageController::class, 'transferComplete']);

 });
