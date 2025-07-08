<?php

namespace Database\Seeders;

use App\Models\BarangMasuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');
        BarangMasuk::insert([
            [
                'tanggal' => '2023-06-19',
                'sumber_dana' => 'Hibah',
                'pemasok_id' => 1,
                'karyawan_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'tanggal' => '2023-06-20',
                'sumber_dana' => 'Hibah',
                'pemasok_id' => 2,
                'karyawan_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'tanggal' => '2023-06-21',
                'sumber_dana' => 'Hibah',
                'pemasok_id' => 1,
                'karyawan_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'tanggal' => '2023-06-22',
                'sumber_dana' => 'Hibah',
                'pemasok_id' => 2,
                'karyawan_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
