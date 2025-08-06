<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NomenclatureController;

Route::middleware('auth:sanctum')->prefix('nomenclature')->group(function () {
    Route::get('/getAutoComplete', [NomenclatureController::class, 'getAutocomplete']);
    Route::get('/speciesAutocomplete', [NomenclatureController::class, 'getSpeciesAutocomplete']);
    Route::get('/', [NomenclatureController::class, 'index']);
    Route::post('/', [NomenclatureController::class, 'store']);
    Route::post('/multiple', [NomenclatureController::class, 'storeMultiple']);
    Route::post('/search', [NomenclatureController::class, 'searchNomenclatures']);
    Route::put('/{id}', [NomenclatureController::class, 'update']);
    Route::delete('/{nomenclatureId}/bibliographies/{bibliographiesId}', [NomenclatureController::class, 'destroyBibliographyReference']);
    Route::delete('/{nomenclatureId}/image/{imageId}', [NomenclatureController::class, 'destroyFile']);
    Route::delete('/{id}', [NomenclatureController::class, 'destroy']);
    Route::get('/{id}', [NomenclatureController::class, 'show']);
});

