<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [\App\Http\Controllers\AuthenticationController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\AuthenticationController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {
Route::get('/lab-tests', [\App\Http\Controllers\LabTestController::class, 'index']);
Route::post('/submit-medical-data', [\App\Http\Controllers\LabTestController::class, 'submit']);
    Route::post('/logout', function (Request $request) {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    });
});
