<?php

use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Api\VendorController;
use App\Http\Controllers\users\userEstimateController;
use App\Http\Controllers\vendor\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Route::get('customers/{customer}/primary-contact', [JobController::class, 'getPrimaryContact']);

// Route::post('/estimate/esignature/{id}', [userEstimateController::class, 'esignature'])->name('esignature');
// Route::post('login', [AttendanceController::class, 'login']);
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('apitest', [AttendanceController::class, 'apitest']);
//     // return $request->user();
// });



// Saad

Route::any('login', [\App\Http\Controllers\Api\RegisterController::class, 'login'])->name('login');
Route::any('verify', [\App\Http\Controllers\Api\RegisterController::class, 'verify']);
Route::post('password/email', [\App\Http\Controllers\Api\ForgotPasswordController::class, 'forget']);
Route::any('password/reset', [\App\Http\Controllers\Api\CodeCheckController::class, 'index']);
Route::post('password/code/check', [\App\Http\Controllers\Api\CodeCheckController::class, 'code_verify']);

Route::group(['middleware' => ['api', 'auth:api'], 'prefix' => 'auth'], function () {
    Route::post('change_password', [\App\Http\Controllers\Api\RegisterController::class, 'change_password']);
});

Route::group(['prefix' => 'vendor', 'middleware' => ['auth:api', 'role:vendor']], function () {

    Route::resource('manage_work_orders', VendorController::class);
});
