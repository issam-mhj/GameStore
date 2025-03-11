<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (apply middleware here)
Route::middleware(\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class)
    ->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/protected', function () {
            return response()->json(['message' => 'Access granted']);
        })->middleware('auth:sanctum');
    });
