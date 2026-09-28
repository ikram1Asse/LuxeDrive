<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\Car;
use App\Models\Sale;
use App\Models\TestDrive;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Route::model('voiture', Car::class);
        Route::model('car', Car::class);
        Route::model('employe', User::class);
        Route::model('rdv', Appointment::class);
        Route::model('reserve', Appointment::class);
        Route::model('vente', Sale::class);
        Route::model('test_drive', TestDrive::class);
    }
}
