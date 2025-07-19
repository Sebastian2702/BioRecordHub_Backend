<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OccurrenceFieldController;

Route::middleware('auth:sanctum')->prefix('admin/occurrenceField')->group(function () {
    Route::get('/', [OccurrenceFieldController::class, 'index']);
    Route::post('/', [OccurrenceFieldController::class, 'store']);
    Route::put('/{id}', [OccurrenceFieldController::class, 'update']);
   /* Route::delete('/{id}', [OccurrenceFieldController::class, 'destroy']);*/
    Route::get('/{id}', [OccurrenceFieldController::class, 'show']);
});
