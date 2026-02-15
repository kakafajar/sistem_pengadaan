<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Spp extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function penawaran(): BelongsTo
    {
        // Artinya: SPP ini "Milik" satu Penawaran
        return $this->belongsTo(Penawaran::class, 'penawaran_id');
    }
}
