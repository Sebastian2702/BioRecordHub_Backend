<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NomenclatureController;

Route::middleware('auth:sanctum')->prefix('nomenclature')->group(function () {
    Route::get('/', [NomenclatureController::class, 'index']);
    Route::get('/{id}', [NomenclatureController::class, 'show']);
    Route::post('/', [NomenclatureController::class, 'store']);
    Route::post('/multiple', [NomenclatureController::class, 'storeMultiple']);
    Route::put('/{id}', [NomenclatureController::class, 'update']);
    Route::delete('/{nomenclatureId}/bibliographies/{bibliographiesId}', [NomenclatureController::class, 'destroyBibliographyReference']);
});

