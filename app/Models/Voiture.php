<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voiture extends Model
{
    protected $table = 'voitures';

    protected $fillable = [
        'modele',
        'annee',
        'prix',
        'kilometrage',
        'carburant',
        'horsepower',
        'drivetrain',
        'transmission',
        'couleur',
        'description',
        'statut',
        'image_principale',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ImageVoiture::class, 'id_voiture');
    }

    public function testDrives(): HasMany
    {
        return $this->hasMany(TestDrive::class, 'id_voiture');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reserve::class, 'id_voiture');
    }

    public function ventes(): HasMany
    {
        return $this->hasMany(Vente::class, 'id_voiture');
    }
}
