<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestDrive extends Model
{
    protected $table = 'test_drives';

    protected $primaryKey = 'id_test_drive';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_client',
        'id_voiture',
        'date_test',
        'heure_test',
        'statut',
        'commentaire',
    ];

    protected $casts = [
        'date_test' => 'date',
    ];

    public function client(): BelongsTo
    {
        // Client primary key is non-standard: id_client
        return $this->belongsTo(Client::class, 'id_client', 'id_client');
    }


    public function voiture(): BelongsTo
    {
        return $this->belongsTo(Voiture::class, 'id_voiture');
    }
}
