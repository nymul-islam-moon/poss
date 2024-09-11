<?php

use App\Http\Controllers\Api\V1\Auth\AuthController as AuthAuthController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=> 'auth', 'middleware' => 'api'], function () {
    Route::post('/register', [AuthAuthController::class, 'register']);
    Route::post('/login', [AuthAuthController::class, 'login']);
    Route::post('/me', [AuthAuthController::class,'me']);
    Route::post('/logout', [AuthAuthController::class,'logout']);
    Route::post('/refresh', [AuthAuthController::class,'refresh']);
    Route::post('/change-password', [AuthAuthController::class,'change_password']);
});