<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    use HasFactory;
    protected $table = 'pemasok';
    protected $guarded = [];

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    /**
     * Otomatis membuat slug dari nama_pemasok saat data disimpan.
     */
    protected static function booted(): void
    {
        static::creating(function ($pemasok) {
            $pemasok->slug = Str::slug($pemasok->nama_pemasok);
        });

        static::updating(function ($pemasok) {
            $pemasok->slug = Str::slug($pemasok->nama_pemasok);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
