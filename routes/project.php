<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::middleware('auth:sanctum')->prefix('project')->group(function () {
    Route::get('/getAutoComplete', [ProjectController::class, 'getProjectsAutoComplete']);
    Route::get('/', [ProjectController::class, 'index']);
    Route::post('/', [ProjectController::class, 'store']);
    Route::put('/{id}', [ProjectController::class, 'update']);
    Route::delete('/{projectId}/file/{fileId}', [ProjectController::class, 'destroyFile']);
    Route::delete('/{id}', [ProjectController::class, 'destroy']);
    Route::get('/{id}', [ProjectController::class, 'show']);
});
