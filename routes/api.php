<?php

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
Route::post('/estimate/esignature/{id}', [userEstimateController::class, 'esignature'])->name('esignature');
Route::post('login', [AttendanceController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('apitest', [AttendanceController::class, 'apitest']);
    // return $request->user();
});
