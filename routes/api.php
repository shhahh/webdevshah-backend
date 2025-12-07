<?php

use App\Http\Controllers\Api\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/test', function () {
    return response()->json([
        'message' => 'Hello from Laravel API ✅',
        'status' => 200
    ]);
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
// 🌟 Admin Test Route
Route::middleware(['auth:sanctum', 'role:Admin'])->get('/admin', function () {
    return response()->json(['message' => 'Admin OK']);
});

// 🌟 Client Test Route
Route::middleware(['auth:sanctum', 'role:Client'])->get('/client', function () {
    return response()->json(['message' => 'Client OK']);
});

Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {

    Route::get('/clients', [ClientController::class, 'index']);
    Route::post('/clients', [ClientController::class, 'store']);
    Route::get('/clients/{id}', [ClientController::class, 'show']);
    Route::put('/clients/{id}', [ClientController::class, 'update']);
    Route::delete('/clients/{id}', [ClientController::class, 'destroy']);

});
