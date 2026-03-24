<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

// Third party API — requires API key in header
Route::middleware('api.key')->group(function () {
    Route::post('/v1/verify',      [ApiController::class, 'verify']);
    Route::get('/v1/result/{code}',[ApiController::class, 'result']);
    Route::get('/v1/usage',        [ApiController::class, 'usage']);
});