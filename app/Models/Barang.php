<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $guarded = [];

    /**
     * Otomatis membuat slug dari nama_barang saat data disimpan.
     */
    protected static function booted(): void
    {
        static::creating(function ($barang) {
            $barang->slug = Str::slug($barang->nama_barang);
        });

        static::updating(function ($barang) {
            $barang->slug = Str::slug($barang->nama_barang);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
