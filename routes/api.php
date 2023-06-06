<?php

use App\Http\Controllers\ReviewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KomersController;
use App\Http\Controllers\AuthenticationController;

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

// ? Storage
Route::get('/komers', [KomersController::class, 'index']);
Route::post('/komers', [KomersController::class, 'store']);
Route::patch('/komers/{id}', [KomersController::class, 'update']);
Route::get('/komers/{id}', [KomersController::class, 'show']);
Route::delete('/komers/{id}', [KomersController::class, 'delete']);

// ? Authentikasi
Route::post('register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/logout', [AuthenticationController::class, 'logout']);

// ? Reviews
Route::post('/reviews', [ReviewsController::class, 'store']);
Route::patch('/reviews/{id}', [ReviewsController::class, 'update']);
Route::delete('/reviews/{id}', [ReviewsController::class, 'delete']);
