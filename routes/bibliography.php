<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BibliographyController;

Route::middleware('auth:sanctum')->prefix('bibliographies')->group(function () {
    Route::get('/', [BibliographyController::class, 'index']);        // Get all
    Route::get('/file/{id}', [BibliographyController::class, 'getFile']); // Get file by ID
    Route::post('/', [BibliographyController::class, 'store']);       // Create
    Route::post('/multiple', [BibliographyController::class, 'storeMultiple']); // Create multiple
    Route::put('/{id}', [BibliographyController::class, 'update']);   // Update
    Route::delete('/{id}', [BibliographyController::class, 'destroy']);// Delete
    Route::delete('/{bibliographyId}/nomenclatures/{nomenclatureId}', [BibliographyController::class, 'destroyNomenclatureReference']);
    Route::delete('/file/{id}', [BibliographyController::class, 'destroyFile']); // Delete file by ID
    Route::get('/{id}', [BibliographyController::class, 'show']);     // Get one
});
