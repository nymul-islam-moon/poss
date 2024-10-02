<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\CustomerController;
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



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(['prefix' => 'auth', 'middleware' => 'auth:api'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/me', 'me')->name('me');
        Route::post('/test', 'test')->name('test');
        Route::post('/refresh', 'refresh')->name('refresh');
        Route::post('/logout', 'logout')->name('logout');
        Route::post('/change_password', 'change_password')->name('change_password');
    });

    Route::controller(CustomerController::class)->group( function () {
        Route::get('/customer', 'index')->name('admin.customer.index');
    });
});
