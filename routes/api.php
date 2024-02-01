<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/signup', [\App\Http\Controllers\AuthController::class, 'signup']);
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:api');
    Route::get('/profile', [\App\Http\Controllers\AuthController::class, 'profile'])->middleware('auth:api');
    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
        Route::get('/profile', [\App\Http\Controllers\AuthController::class, 'profile']);
        Route::get('/orders',[\App\Http\Controllers\OrderController::class,'index']);
        Route::post('/add_order',[\App\Http\Controllers\OrderController::class,'store']);
        Route::post('add_offer',[\App\Http\Controllers\OfferController::class,'store']);
        Route::get('/offers',[\App\Http\Controllers\OfferController::class,'index']);
    });

Route::get('send',[\App\Http\Controllers\SendController::class,'send']);

