<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employe extends Model
{
    protected $table = 'employes';

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'role',
        'date_embauche',
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
