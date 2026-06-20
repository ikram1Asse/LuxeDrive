<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vente extends Model
{
    protected $table = 'ventes';
    
    protected $primaryKey = 'id_vente';

    protected $fillable = [
        'id_client',
        'id_voiture',
        'id_employe',
        'date_vente',
        'prix_final',
        'mode_paiement',
        'statut',
        'commentaire',
    ];

    protected $casts = [
        'date_vente' => 'date',
        'prix_final' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function voiture(): BelongsTo
    {
        return $this->belongsTo(Voiture::class, 'id_voiture');
    }

    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'id_employe');
    }

    public function effectues(): HasMany
    {
        return $this->hasMany(Effectue::class, 'id_vente');
    }
}
