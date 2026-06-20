<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Demande extends Model
{
    protected $table = 'demandes';

    protected $fillable = [
        'id_client',
        'date_demande',
        'contenu',
    ];

    protected $casts = [
        'date_demande' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
}
