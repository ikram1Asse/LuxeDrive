<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserve extends Model
{
    protected $table = 'reserves';
    protected $primaryKey = 'id_reserve';

    protected $fillable = [
        'id_client',
        'id_voiture',
        'date_rdv',
        'heure_rdv',
        'statut',
        'commentaire',
    ];

    protected $casts = [
        'date_rdv' => 'date',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function voiture(): BelongsTo
    {
        return $this->belongsTo(Voiture::class, 'id_voiture');
    }
}
