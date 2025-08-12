<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelExportController;

Route::middleware('auth:sanctum')->prefix('excel_export')->group(function () {
    Route::get('/occurrence/{id}', [ExcelExportController::class, 'exportSingleExcel']);
    Route::post('/occurrence', [ExcelExportController::class, 'exportExcelOccurrences']);
    Route::post('/nomenclature', [ExcelExportController::class, 'exportExcelNomenclatures']);
    Route::post('/bibliography', [ExcelExportController::class, 'exportExcelBibliographies']);
    Route::post('/projects', [ExcelExportController::class, 'exportExcelProjects']);
});
