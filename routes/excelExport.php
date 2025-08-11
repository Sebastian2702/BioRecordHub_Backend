<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelExportController;

Route::middleware('auth:sanctum')->prefix('excel_export')->group(function () {
    Route::get('/occurrence', [ExcelExportController::class, 'exportExcelOccurrences']);
    Route::get('/occurrence/{id}', [ExcelExportController::class, 'exportSingleExcel']);
});
