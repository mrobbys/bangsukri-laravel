<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk';
    protected $guarded = [];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class);
    }
}
