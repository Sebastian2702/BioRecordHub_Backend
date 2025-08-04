<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OccurrenceController;

Route::middleware('auth:sanctum')->prefix('occurrence')->group(function () {
    Route::get('/', [OccurrenceController::class, 'index']);
    Route::post('/', [OccurrenceController::class, 'store']);
    Route::put('/{id}', [OccurrenceController::class, 'update']);
    Route::delete('/{id}', [OccurrenceController::class, 'destroy']);
    Route::get('/{id}', [OccurrenceController::class, 'show']);
});
