<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;

// Ruta de prueba básica
Route::get('/test', function() {
    return response()->json(['message' => 'API is working!']);
});

// Grupo principal con prefijo 'med'
Route::group(['prefix' => 'med'], function () {
    
    // Grupo de autenticación
    Route::group(['prefix' => 'auth'], function() {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        
        // Rutas protegidas que requieren autenticación
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/user-profile', [AuthController::class, 'userProfile']);
        });
    });
    
    // Grupo de doctores (protegido)
    Route::middleware('auth:sanctum')->group(function () {
        Route::group(['prefix' => 'doctors'], function() {
            Route::get('/', [DoctorController::class, 'index']);
            Route::get('/{id}', [DoctorController::class, 'show']);
            Route::put('/profile', [DoctorController::class, 'updateProfile']);
        });
    });
});