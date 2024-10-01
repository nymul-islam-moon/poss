<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
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


// Route::group(['prefix' => 'auth'], function () {
//     // Routes that do not require authentication
//     Route::post('/register', [AuthController::class, 'register']);
//     Route::post('/login', [AuthController::class, 'login']);
    
//     // Routes that require authentication
//     Route::middleware('api')->group(function () {
//         Route::get('/me', [AuthController::class, 'me']); // Change to GET
//         Route::post('/logout', [AuthController::class, 'logout']);
//         Route::post('/refresh', [AuthController::class, 'refresh']);
//         Route::post('/change-password', [AuthController::class, 'change_password']);
//     });
// });


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(['prefix' => 'auth'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/me', 'me')->name('me');
        Route::post('/test', 'test')->name('test');
        Route::post('/refresh', 'refresh')->name('refresh');
        Route::post('/logout', 'logout')->name('logout');
    });
});
