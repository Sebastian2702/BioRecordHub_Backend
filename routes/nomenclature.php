<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NomenclatureController;

Route::middleware('auth:sanctum')->prefix('nomenclature')->group(function () {
    Route::get('/', [NomenclatureController::class, 'index']);
});

