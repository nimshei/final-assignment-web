<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LicenseController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VehicleController;
use App\Http\Controllers\API\AccidentController;
use App\Http\Controllers\API\OffenceController;
use App\Http\Controllers\API\ViolationController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {

    // License APIs
    Route::patch('/licenses/{licenseId}/toggle-status', [LicenseController::class, 'toggleActiveStatus']);
    Route::get('/licenses', [LicenseController::class, 'getLicenses']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // User APIs
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::get('/users/{userId}', [UserController::class, 'getUserById']);
    Route::post('/users', [UserController::class, 'createUser']);

    // Vehicle APIs
    Route::get('/vehicles', [VehicleController::class, 'getVehicles']);

    // Accident APIs
    Route::get('/accidents', [AccidentController::class, 'getAccidents']);
    Route::post('/accidents', [AccidentController::class, 'createAccident']);

    // Offence APIs
    Route::get('/offences', [OffenceController::class, 'getOffences']);
    Route::post('/offences', [OffenceController::class, 'createOffence']);

    // Violation APIs
    Route::get('/violations', [ViolationController::class, 'getViolations']);
    // Route::post('/violations', [ViolationController::class, 'createViolation']);
});
