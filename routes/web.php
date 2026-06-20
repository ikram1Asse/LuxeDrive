<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\TestDriveController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\VoitureAdminController;
use App\Http\Controllers\TestDriveAdminController;
use App\Http\Controllers\ReserveAdminController;
use App\Http\Controllers\RendezVousAdminController;
use App\Http\Controllers\VenteAdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class,'index']);

// Auth Routes

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.store');

Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup.show');
Route::post('/signup', [AuthController::class, 'storeSignup'])->name('signup.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['admin', 'admin.full'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Admin Management Routes 
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/management', [AdminController::class, 'management'])->name('management');

        // Admin CRUD
        Route::resource('rdv', RendezVousAdminController::class, ['except' => 'show']);
        Route::resource('ventes', VenteAdminController::class, ['except' => 'show']);
        Route::resource('voitures', VoitureAdminController::class, ['except' => 'show']);
        Route::resource('test-drives', TestDriveAdminController::class, ['except' => 'show']);
        Route::resource('reserves', ReserveAdminController::class, ['except' => 'show', 'parameters' => ['reserves' => 'reserve']]);
        Route::resource('employes', EmployeController::class, ['except' => 'show']);
    });

    // Employee View-Only Routes (employees only)
    Route::middleware(['admin', 'employee.readonly'])->prefix('employee')->name('employee.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'employeeDashboard'])->name('dashboard');

        // Employee read-only
        Route::get('/employes', [EmployeController::class, 'indexReadOnly'])->name('employes.index');
        Route::get('/voitures', [VoitureAdminController::class, 'indexReadOnly'])->name('voitures.index');
        Route::get('/test-drives', [TestDriveAdminController::class, 'indexReadOnly'])->name('test-drives.index');
        Route::get('/reserves', [ReserveAdminController::class, 'indexReadOnly'])->name('reserves.index');
        Route::get('/rdv', [RendezVousAdminController::class, 'indexReadOnly'])->name('rdv.index');
        Route::get('/ventes', [VenteAdminController::class, 'indexReadOnly'])->name('ventes.index');
    });
});

// Models Route
Route::get('/models', [VoitureController::class, 'index']);
Route::get('/models/{voiture}', [VoitureController::class, 'show'])->name('models.carDetails');
Route::resource('voitures', VoitureController::class);

// Backward-compat route name used by some redirects/views
// (kept as an alias to avoid Route [login.show] not defined exceptions)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');





// Test Drive Routes
Route::get('/book-test-drive', [TestDriveController::class, 'showBook'])->name('testdrive.book');
Route::post('/book-test-drive', [TestDriveController::class, 'storeBook'])->name('testdrive.store');

// Appointment Routes
Route::get('/book-appointment', [AppointmentController::class, 'showBook'])->name('appointment.book');
Route::post('/book-appointment', [AppointmentController::class, 'storeBook'])->name('appointment.store');

// Profile Routes (Protected by client auth)
Route::middleware('auth:client')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

