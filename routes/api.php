<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\AuthController;
 use App\Http\Controllers\EmployeeController;
 use App\Http\Controllers\PointageController;
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
        Route::get('/employees{id}', [EmployeeController ::class, 'show']);
        Route::patch('/employees{id}', [EmployeeController ::class, 'update']);
        Route::patch('/employees{id}', [EmployeeController ::class, 'delete']);

        Route::post('/pointages', [PointageController ::class, 'store']);