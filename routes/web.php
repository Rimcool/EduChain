<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\PortalController;

// Public
Route::get('/',              fn() => view('landing'))->name('home');
Route::get('/check/{code}',  [VerifyController::class, 'show'])->name('verify.public');

// Auth
Route::get('/login',         [AuthController::class, 'loginForm'])->name('login');
Route::post('/login',        [AuthController::class, 'login']);
Route::post('/logout',       [AuthController::class, 'logout'])->name('logout');
Route::get('/register',      [AuthController::class, 'registerForm'])->name('register');
Route::post('/register',     [AuthController::class, 'register']);

// Recruiter
Route::middleware('auth')->group(function () {
    Route::get('/verify',        [VerifyController::class, 'index'])->name('verify');
    Route::post('/verify/check', [VerifyController::class, 'check'])->name('verify.check');
});

// University portal
Route::middleware(['auth', 'role:university'])->group(function () {
    Route::get('/portal',         [PortalController::class, 'index'])->name('portal');
    Route::post('/portal/issue',  [PortalController::class, 'issue'])->name('portal.issue');
});