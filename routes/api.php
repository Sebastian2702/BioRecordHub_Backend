<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

require __DIR__.'/bibliography.php';
require __DIR__.'/excelImport.php';
require __DIR__.'/nomenclature.php';
require __DIR__.'/occurrenceField.php';
require __DIR__ . '/adminUser.php';
require __DIR__.'/project.php';
require __DIR__.'/occurrence.php';
require __DIR__.'/excelExport.php';
