<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    VerifyController,
    HistoryController,
    StudentController,
    PortalController,
    AdminController,
    PublicController
};

// ── PUBLIC (no login needed) ─────────────────────────────
Route::get('/',                    [PublicController::class, 'landing'])->name('home');
Route::get('/universities',        [PublicController::class, 'universities'])->name('universities');
Route::get('/check/{code}',        [PublicController::class, 'result'])->name('result.public');
Route::get('/badge/{slug}',        [PublicController::class, 'badge'])->name('badge');
Route::get('/stats',               [PublicController::class, 'stats'])->name('stats');
Route::get('/api/stats',           [PublicController::class, 'statsJson']);
Route::get('/api/universities/search', [PublicController::class, 'uniSearch']);
Route::get('/verify/public',       [PublicController::class, 'publicVerify'])->name('verify.public.form');

// ── AUTH ─────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',           [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login',          [AuthController::class, 'login']);
    Route::get('/register',        [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register',       [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/pending', [AuthController::class, 'pending'])->name('pending')->middleware('auth');

// ── RECRUITER ────────────────────────────────────────────
Route::middleware(['auth', 'role:recruiter', 'approved'])->group(function () {
    Route::get('/verify',              [VerifyController::class, 'index'])->name('verify');
    Route::post('/verify/check',       [VerifyController::class, 'check'])->name('verify.check');
    Route::post('/verify/bulk',        [VerifyController::class, 'bulk'])->name('verify.bulk');
    Route::get('/verify/{code}/pdf',   [VerifyController::class, 'pdf'])->name('verify.pdf');
    Route::get('/verify/history',      [VerifyController::class, 'history'])->name('verify.history');
});

// ── PUBLIC VERIFY ────────────────────────────────────────
Route::get('/check/{code}', [VerifyController::class, 'publicResult'])->name('verify.public');

// ── OCR ──────────────────────────────────────────────────
Route::middleware(['auth', 'role:recruiter', 'approved'])->group(function () {
    Route::post('/verify/ocr', [VerifyController::class, 'ocr'])->name('verify.ocr');
});

// ── STUDENT ──────────────────────────────────────────────
Route::middleware(['auth', 'role:student', 'approved'])->group(function () {
    Route::get('/my-degree',           [StudentController::class, 'index'])->name('student.dashboard');
    Route::post('/my-degree/claim',    [StudentController::class, 'claim'])->name('student.claim');
    Route::get('/my-degree/badge',     [StudentController::class, 'badge'])->name('student.badge');
});

// ── UNIVERSITY ───────────────────────────────────────────
Route::middleware(['auth', 'role:university', 'approved'])->group(function () {
    Route::get('/portal',              [PortalController::class, 'index'])->name('portal');
    Route::post('/portal/issue',       [PortalController::class, 'issue'])->name('portal.issue');
    Route::get('/portal/degrees',      [PortalController::class, 'degrees'])->name('portal.degrees');
    Route::post('/portal/bulk',        [PortalController::class, 'bulk'])->name('portal.bulk');
    Route::get('/portal/export',       [PortalController::class, 'export'])->name('portal.export');
});

// ── SUPER ADMIN ──────────────────────────────────────────
Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->group(function () {
    Route::get('/',                    [AdminController::class, 'index'])->name('admin');
    Route::get('/universities',        [AdminController::class, 'universities'])->name('admin.universities');
    Route::post('/universities/{id}/approve',   [AdminController::class, 'approve']);
    Route::post('/universities/{id}/blacklist', [AdminController::class, 'blacklist']);
    Route::post('/universities/{id}/unblacklist',[AdminController::class,'unblacklist']);
    Route::get('/users',               [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{id}/suspend', [AdminController::class, 'suspend']);
    Route::post('/users/{id}/activate',[AdminController::class, 'activate']);
    Route::get('/verifications',       [AdminController::class, 'verifications'])->name('admin.verifications');
    Route::get('/pending',             [AdminController::class, 'pending'])->name('admin.pending');
    Route::get('/fraud',               [AdminController::class, 'fraud'])->name('admin.fraud');
    Route::get('/licenses',            [AdminController::class, 'licenses'])->name('admin.licenses');
    Route::post('/degrees/{id}/revoke',[AdminController::class, 'revoke']);
});