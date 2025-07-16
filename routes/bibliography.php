<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BibliographyController;

Route::middleware('auth:sanctum')->prefix('bibliographies')->group(function () {
    Route::get('/', [BibliographyController::class, 'index']);        // Get all
    Route::get('/{id}', [BibliographyController::class, 'show']);     // Get one
    Route::post('/', [BibliographyController::class, 'store']);       // Create
    Route::post('/multiple', [BibliographyController::class, 'storeMultiple']); // Create multiple
    Route::put('/{id}', [BibliographyController::class, 'update']);   // Update
    Route::delete('/{id}', [BibliographyController::class, 'destroy']);// Delete
    Route::delete('/{bibliographyId}/nomenclatures/{nomenclatureId}', [BibliographyController::class, 'destroyNomenclatureReference']);
});
