<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\DiagnosisExportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserHistoryController;

// Redirect root to diagnosis
Route::get('/', function () {
    return redirect()->route('diagnosis.index');
});

// Diagnosis routes (available for all users)
Route::get('/diagnosis', [DiagnosisController::class, 'index'])->name('diagnosis.index');
Route::post('/diagnosis', [DiagnosisController::class, 'diagnose'])->name('diagnosis.diagnose');
Route::get('/disease/{id}', [DiagnosisController::class, 'showDisease'])->name('disease.show');

// Export PDF routes (available for all users)
Route::get('/diagnosis/export-session-pdf', [DiagnosisExportController::class, 'exportSessionPdf'])->name('diagnosis.export.session.pdf');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// User authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/user/history', [UserHistoryController::class, 'index'])->name('user.history');
    Route::get('/user/diagnosis/{id}', [UserHistoryController::class, 'show'])->name('user.diagnosis.show');
    Route::delete('/user/diagnosis/{id}', [UserHistoryController::class, 'destroy'])->name('user.diagnosis.destroy');

    // Export PDF for authenticated users
    Route::get('/diagnosis/export-pdf/{id}', [DiagnosisExportController::class, 'exportPdf'])->name('diagnosis.export.pdf');
});

// Admin route will be handled by Filament automatically
