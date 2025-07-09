<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = "karyawan";
    protected $guarded = [];

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    /**
     * Otomatis membuat slug dari nama_karyawan saat data disimpan.
     */
    protected static function booted(): void
    {
        static::creating(function ($karyawan) {
            $karyawan->slug = Str::slug($karyawan->nama_karyawan);
        });

        static::updating(function ($karyawan) {
            $karyawan->slug = Str::slug($karyawan->nama_karyawan);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
