<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelImportController;

Route::middleware('auth:sanctum')->prefix('excel_import')->group(function () {
    Route::post('/bibliography', [ExcelImportController::class, 'importBibliography']);
});
