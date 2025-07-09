<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = "jabatans";
    protected $guarded = [];

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class);
    }

    /**
     * Otomatis membuat slug dari nama_karyawan saat data disimpan.
     */
    protected static function booted(): void
    {
        static::creating(function ($jabatan) {
            $jabatan->slug = Str::slug($jabatan->nama_jabatan);
        });

        static::updating(function ($jabatan) {
            $jabatan->slug = Str::slug($jabatan->nama_jabatan);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
