<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\ClubController;
use App\Http\Controllers\API\V1\EventController;
use App\Http\Controllers\API\V1\ForgotPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

    Route::get('/events', [EventController::class, 'index'])->name('api.v1.events.index');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('api.v1.events.show');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', fn(Request $request) => $request->user());

        // Explicit Club Routes
        Route::get('/clubs', [ClubController::class, 'index'])->name('api.v1.clubs.index');
        Route::post('/clubs', [ClubController::class, 'store'])->name('api.v1.clubs.store');
        Route::get('/clubs/{club}', [ClubController::class, 'show'])->name('api.v1.clubs.show');
        Route::put('/clubs/{club}', [ClubController::class, 'update'])->name('api.v1.clubs.update');
        Route::delete('/clubs/{club}', [ClubController::class, 'destroy'])->name('api.v1.clubs.destroy');

        // Explicit Event Routes
        Route::post('/events', [EventController::class, 'store'])->name('api.v1.events.store');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('api.v1.events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('api.v1.events.destroy');
    });
});
