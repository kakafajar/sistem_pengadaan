<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penawaran extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function spp(): HasOne
    {
        // Artinya: Satu Penawaran "Punya Satu" SPP
        return $this->hasOne(Spp::class, 'penawaran_id');
    }
}
