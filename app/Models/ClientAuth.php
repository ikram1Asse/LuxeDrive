<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClientAuth extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'clients';

    protected $primaryKey = 'id_client';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'date_inscription',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
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

