<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;
    protected $table = "ruang";
    protected $guarded = [];

    /**
     * Otomatis membuat slug dari nama_ruang saat data disimpan.
     */
    protected static function booted(): void
    {
        static::creating(function ($ruang) {
            $ruang->slug = Str::slug($ruang->nama_ruang);
        });

        static::updating(function ($ruang) {
            $ruang->slug = Str::slug($ruang->nama_ruang);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
