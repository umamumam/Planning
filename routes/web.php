<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MSController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\PlaningController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/coba', function () {
    return view('coba');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('kategoris', KategoriController::class);
    Route::get('calendar', [PlaningController::class, 'calendar'])->name('planings.calendar');
    Route::get('/planings/events', [PlaningController::class, 'getEvents'])->name('planings.events');
    Route::get('/planings/{planing}', [PlaningController::class, 'show'])->name('planings.show');
    Route::get('/laporan', [PlaningController::class, 'laporan'])->name('planings.laporan');
    // Route::get('/planingku/laporan/export-pdf', [PlaningController::class, 'exportPDF'])->name('planings.export.pdf');
    Route::resource('planings', PlaningController::class);
    Route::resource('tamus', TamuController::class);
    Route::resource('ms', MSController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__ . '/auth.php';
