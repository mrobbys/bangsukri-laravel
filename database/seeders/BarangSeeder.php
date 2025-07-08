<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $now = date('Y-m-d H:i:s');
        // Barang::insert([
        //     [
        //         'nama_barang' => 'Kursi Kantor',
        //         'merk' => 'Doodook',
        //         'tipe' => 'Kursi kantor air spring',
        //         'satuan' => 'unit',
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ],
        //     [
        //         'nama_barang' => 'Meja Kantor',
        //         'merk' => 'Doodook',
        //         'tipe' => 'Meja kantor air spring',
        //         'satuan' => 'unit',
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ]
        //     ]);

        $barangs = [
            ['nama_barang' => 'Kursi Kantor', 'merk' => 'Doodook', 'tipe' => 'Kursi kantor air spring', 'satuan' => 'unit'],
            ['nama_barang' => 'Meja Kantor', 'merk' => 'Doodook', 'tipe' => 'Meja kantor air spring', 'satuan' => 'unit'],
        ];
        // Gunakan perulangan dan metode create()
        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}
