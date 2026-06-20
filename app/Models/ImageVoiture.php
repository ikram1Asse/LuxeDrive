<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageVoiture extends Model
{
    protected $table = 'image_voitures';

    protected $primaryKey = 'id_image';

    protected $fillable = [
        'id_voiture',
        'url',
        'ordre',
    ];

    public function voiture(): BelongsTo
    {
        return $this->belongsTo(Voiture::class, 'id_voiture');
    }
}
