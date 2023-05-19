<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\AuthController;
 use App\Http\Controllers\EmployeeController;
 use App\Http\Controllers\PointageController;
 use App\Http\Controllers\UserController;
 use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers;
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


    
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('/sign_in', [AuthController::class, 'sign_in']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/employees', [EmployeeController ::class, 'store']);
        Route::get('/employees', [EmployeeController ::class, 'index']);
        Route::get('/employees/{id}', [EmployeeController ::class, 'show']);
        Route::patch('/employees/{id}', [EmployeeController ::class, 'update']);
        Route::delete('/employees/{id}', [EmployeeController ::class, 'delete']);

        Route::post('/pointages', [PointageController ::class, 'store']);
        Route::get('/pointages', [PointageController ::class, 'index']);
        Route::get('/pointages/{id}', [PointageController ::class, 'show']);
        Route::patch('/pointages/{id}', [PointageController ::class, 'update']);
        Route::delete('/pointages/{id}', [PointageController ::class, 'delete']);

        Route::post('/leave-requests', [LeaveRequestController::class, 'store']);
        Route::patch('/leave-requests/{id}/accept', [LeaveRequestController::class, 'accept']);
        Route::patch('/leave-requests/{id}/deny', [LeaveRequestController::class, 'deny']);
        Route::get('/employees/{id}/leave-requests', [LeaveRequestController::class, 'getByEmployee']);
        Route::get('/leave-requests', [LeaveRequestController::class, 'getAll']);
