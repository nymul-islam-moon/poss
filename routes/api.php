<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\CRM\CustomerController;
use App\Http\Controllers\Api\V1\HRM\DepartmentController;
use App\Http\Controllers\Api\V1\HRM\EmployeeController;
use App\Http\Controllers\Api\V1\HRM\JobController;
use App\Http\Middleware\CheckApiAuthenticated;
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


Route::post('/register/store', [AuthController::class, 'register']);
Route::post('/login/store', [AuthController::class, 'login']);
Route::group(['prefix' => 'auth', 'middleware' => [ 'auth:api' ]], function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('/me', 'me')->name('me');
        Route::get('/test', 'test')->name('test');
        Route::post('/refresh', 'refresh')->name('refresh');
        Route::post('/logout', 'logout')->name('logout');
        Route::post('/change_password', 'change_password')->name('change_password');
    });

    Route::controller(CustomerController::class)->prefix('customer')->group( function () {
        Route::get('/{search?}', 'index')->name('admin.customer.index');
        Route::post('/store', 'store')->name('admin.customer.store');
        Route::delete('/destroy/{id}', 'destroy')->name('admin.customer.destroy');
    });

    Route::controller(CountryController::class)->group( function () {
        Route::get('/country', 'index')->name('admin.country.index');
    });

    // HRM
    Route::controller(DepartmentController::class)->prefix('department')->group( function () {
        Route::get('/{search?}', 'index')->name('admin.department.index');
        Route::post('/store', 'store')->name('admin.department.store');
        Route::get('/show/{department}', 'show')->name('admin.department.show');
        Route::put('/update/{department}', 'update')->name('admin.department.update');
        Route::delete('/destroy/{department}', 'destroy')->name('admin.department.destroy');
    });

    Route::controller(JobController::class)->prefix('job')->group( function () {
        Route::get('/{search?}', 'index')->name('admin.job.index');
        Route::post('/store', 'store')->name('admin.job.store');
        Route::get('/show/{job}', 'show')->name('admin.job.show');
        Route::put('/update/{job}', 'update')->name('admin.job.update');
        Route::delete('/destroy/{job}', 'destroy')->name('admin.job.destroy');
    });

    Route::controller(EmployeeController::class)->prefix('employee')->group(function () {
        Route::get('/{search?}', 'index')->name('admin.employee.index');
        Route::post('/store', 'store')->name('admin.employee.store');
        Route::get('/show/{employee}', 'show')->name('admin.employee.show');
        Route::put('/update/{employee}', 'update')->name('admin.employee.update');
        Route::delete('/destroy/{employee}', 'destroy')->name('admin.employee.destroy');
    });
});
