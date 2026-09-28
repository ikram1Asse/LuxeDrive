<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RendezVousAdminController;
use App\Http\Controllers\ReserveAdminController;
use App\Http\Controllers\TestDriveAdminController;
use App\Http\Controllers\TestDriveController;
use App\Http\Controllers\VenteAdminController;
use App\Http\Controllers\VoitureAdminController;
use App\Http\Controllers\VoitureController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.store');
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup.show');
Route::post('/signup', [AuthController::class, 'storeSignup'])->name('signup.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::middleware('admin')->group(function () {
    Route::middleware('admin.full')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/management', [AdminController::class, 'management'])->name('management');

        Route::resource('rdv', RendezVousAdminController::class, ['except' => 'show']);
        Route::resource('ventes', VenteAdminController::class, ['except' => 'show']);
        Route::resource('voitures', VoitureAdminController::class, ['except' => 'show']);
        Route::resource('test-drives', TestDriveAdminController::class, ['except' => 'show']);
        Route::resource('reserves', ReserveAdminController::class, ['except' => 'show', 'parameters' => ['reserves' => 'reserve']]);
        Route::resource('employes', EmployeController::class, ['except' => 'show']);
    });

    Route::middleware('employee.readonly')->prefix('employee')->name('employee.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'employeeDashboard'])->name('dashboard');
        Route::get('/employes', [EmployeController::class, 'indexReadOnly'])->name('employes.index');
        Route::get('/voitures', [VoitureAdminController::class, 'indexReadOnly'])->name('voitures.index');
        Route::get('/test-drives', [TestDriveAdminController::class, 'indexReadOnly'])->name('test-drives.index');
        Route::get('/reserves', [ReserveAdminController::class, 'indexReadOnly'])->name('reserves.index');
        Route::get('/rdv', [RendezVousAdminController::class, 'indexReadOnly'])->name('rdv.index');
        Route::get('/ventes', [VenteAdminController::class, 'indexReadOnly'])->name('ventes.index');
    });
});

Route::get('/models', [VoitureController::class, 'index']);
Route::get('/models/{car}', [VoitureController::class, 'show'])->name('models.carDetails');
Route::resource('voitures', VoitureController::class);

Route::get('/book-test-drive', [TestDriveController::class, 'showBook'])->name('testdrive.book');
Route::post('/book-test-drive', [TestDriveController::class, 'storeBook'])->name('testdrive.store');

Route::get('/book-appointment', [AppointmentController::class, 'showBook'])->name('appointment.book');
Route::post('/book-appointment', [AppointmentController::class, 'storeBook'])->name('appointment.store');

Route::middleware('auth:client')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
