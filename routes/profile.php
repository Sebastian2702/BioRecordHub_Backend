<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ProfilePasswordController;

Route::post('/user/forgot-password', [ProfilePasswordController::class, 'forgotPassword'])->name('user.forgot-password');

Route::middleware('auth')->group(function () {
    Route::post('/user/password', [ProfilePasswordController::class, 'updatePassword'])->name('user.password.update');
    Route::post('/user/email', [ProfilePasswordController::class, 'updateEmail'])->name('user.email.update');
    Route::post('/user/first-login', [ProfilePasswordController::class, 'firstLogin'])->name('user.first-login');
    Route::post('/user/reset-password-token', [ProfilePasswordController::class, 'resetPasswordToken'])->name('user.reset-password-token');
});
