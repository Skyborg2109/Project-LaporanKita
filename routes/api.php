<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\LaporanApiController;

/*
|--------------------------------------------------------------------------
| API Routes - Project LaporanKita
|--------------------------------------------------------------------------
|
| RESTful API menggunakan Laravel Sanctum
| Base URL: http://localhost/Project-LaporanKita/public/api
|
*/

// ============================
// AUTH ENDPOINTS (tanpa token)
// ============================
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthApiController::class, 'register']);  // POST /api/auth/register
    Route::post('/login',    [AuthApiController::class, 'login']);     // POST /api/auth/login
});

// ============================
// PUBLIC ENDPOINTS (tanpa token)
// ============================
Route::prefix('laporan')->group(function () {
    Route::get('/',    [LaporanApiController::class, 'index']);  // GET /api/laporan
    Route::get('/{id}', [LaporanApiController::class, 'show']); // GET /api/laporan/{id}
});

// ============================
// PROTECTED ENDPOINTS (perlu Bearer Token)
// ============================
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/auth/logout', [AuthApiController::class, 'logout']); // POST /api/auth/logout
    Route::get('/auth/me',      [AuthApiController::class, 'me']);     // GET  /api/auth/me

    // Laporan CRUD
    Route::prefix('laporan')->group(function () {
        Route::post('/',         [LaporanApiController::class, 'store']);     // POST   /api/laporan
        Route::put('/{id}',      [LaporanApiController::class, 'update']);   // PUT    /api/laporan/{id}
        Route::delete('/{id}',   [LaporanApiController::class, 'destroy']); // DELETE /api/laporan/{id}
        Route::get('/saya/list', [LaporanApiController::class, 'myLaporan']); // GET   /api/laporan/saya/list
    });
});
