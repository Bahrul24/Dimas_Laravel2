<?php

use App\Http\Controllers\api\authController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\TaskController as ApiController;
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

// Login
Route::post('login', [authController::class, "login"]);

Route::middleware('auth:sanctum')->group( function (): void {
    Route::apiResource('ApiTask', ApiController::class);
    Route::get('logout', [authController::class,"logout"]);
});