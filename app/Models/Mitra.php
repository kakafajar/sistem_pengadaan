<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    protected $fillable = [
        'nama_mitra',
        'nama_bank',
        'no_rekening',
        'atas_nama',
    ];
}
