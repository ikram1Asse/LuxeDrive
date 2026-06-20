<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class EmployeAuth extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'employes';

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'role',
        'date_embauche',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'date_embauche' => 'date',
    ];

    public function ventes(): HasMany
    {
        return $this->hasMany(Vente::class, 'id_employe');
    }

    public function effectues(): HasMany
    {
        return $this->hasMany(Effectue::class, 'id_employe');
    }
}

