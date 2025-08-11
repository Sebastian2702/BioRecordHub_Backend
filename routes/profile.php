<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ProfilePasswordController;

Route::middleware('auth')->group(function () {
    Route::post('/user/password', [ProfilePasswordController::class, 'updatePassword'])->name('user.password.update');
    Route::post('/user/email', [ProfilePasswordController::class, 'updateEmail'])->name('user.email.update');
});
