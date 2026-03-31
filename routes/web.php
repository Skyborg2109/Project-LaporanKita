<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardUserController;
use App\Models\Laporan;

// Halaman Guest
Route::get('/', function () {
    // public feed untuk ditampilkan di landing page
    $laporans = Laporan::with('user')->latest()->take(3)->get();
    
    // Ambil 1 laporan terbaru untuk hero section
    $latestReport = Laporan::latest()->first();
    
    // Statistik laporan
    $totalLaporan = Laporan::count();
    $laporanDiproses = Laporan::where('status', 'diproses')->count();
    $laporanSelesai = Laporan::where('status', 'selesai')->count();
    
    return view('landingpage', compact('laporans', 'latestReport', 'totalLaporan', 'laporanDiproses', 'laporanSelesai'));
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// Halaman yang butuh login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // User Dashboard & Reports
    Route::get('/dashboarduser', [DashboardUserController::class, 'index'])->name('dashboarduser.index');
    Route::get('/buatlaporan', [DashboardUserController::class, 'create'])->name('laporan.create');
    Route::post('/buatlaporan', [DashboardUserController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{id}', [DashboardUserController::class, 'show'])->name('laporan.show');
    Route::get('/laporansaya', [DashboardUserController::class, 'laporansaya'])->name('dashboarduser.laporan');

    // User Profile
    Route::get('/profil', [DashboardUserController::class, 'profil'])->name('dashboarduser.profil');
    Route::post('/profil', [DashboardUserController::class, 'updateProfil'])->name('dashboarduser.profil.update');
    Route::post('/profil/password', [DashboardUserController::class, 'updatePassword'])->name('dashboarduser.profil.password');

    // User Notifikasi
    Route::get('/notifikasi', [DashboardUserController::class, 'notifikasi'])->name('dashboarduser.notifikasi');
    Route::post('/notifikasi/read', [DashboardUserController::class, 'markNotifRead'])->name('dashboarduser.notifikasi.read');

    // Admin Dashboard & Management
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboardadmin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboardadmin/laporan', [DashboardAdminController::class, 'semuaLaporan'])->name('admin.laporan');
        Route::get('/dashboardadmin/laporan/{id}', [DashboardAdminController::class, 'show'])->name('admin.laporan.show');
        Route::post('/dashboardadmin/laporan/{id}/status', [DashboardAdminController::class, 'updateStatus'])->name('admin.laporan.update');
        Route::get('/dashboardadmin/filter', [DashboardAdminController::class, 'filterLaporan'])->name('admin.filter');

        // Admin Profile
        Route::get('/dashboardadmin/profil', [DashboardAdminController::class, 'profil'])->name('admin.profil');
        Route::post('/dashboardadmin/profil', [DashboardAdminController::class, 'updateProfil'])->name('admin.profil.update');
        Route::post('/dashboardadmin/profil/password', [DashboardAdminController::class, 'updatePassword'])->name('admin.profil.password');
    });
});
    



