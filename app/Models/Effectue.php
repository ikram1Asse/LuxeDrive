<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Effectue extends Model
{
    protected $table = 'effectues';

    protected $fillable = [
        'id_vente',
        'id_employe',
    ];

    public function vente(): BelongsTo
    {
        return $this->belongsTo(Vente::class, 'id_vente');
    }

    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'id_employe');
    }
}
