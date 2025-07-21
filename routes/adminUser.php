<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;

Route::middleware('auth:sanctum')->prefix('/admin/users')->group(function () {
    Route::get('/', [AdminUserController::class, 'index']);
    Route::delete('/{id}', [AdminUserController::class, 'destroy']);
    Route::put('/{id}', [AdminUserController::class, 'updateRole']);
});
