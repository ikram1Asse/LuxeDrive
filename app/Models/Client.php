<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $primaryKey = 'id_client';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'date_inscription',
    ];


    protected $casts = [
        'date_inscription' => 'datetime',
    ];

    public function demandes(): HasMany
    {
        return $this->hasMany(Demande::class, 'id_client');
    }

    public function testDrives(): HasMany
    {
        return $this->hasMany(TestDrive::class, 'id_client');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reserve::class, 'id_client');
    }

    public function ventes(): HasMany
    {
        return $this->hasMany(Vente::class, 'id_client');
    }
}
