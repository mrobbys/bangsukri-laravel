<?php

namespace Database\Seeders;

use App\Models\Pemasok;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemasokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $now = date('Y-m-d H:i:s');
        // Pemasok::insert([
        //     [
        //         'nama_pemasok' => 'PT. ABC',
        //         'nama_kontak' => 'John Doe',
        //         'nomor_hp' => '1234567890',
        //         'alamat' => 'Jl. ABC No. 123',
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ],
        //     [
        //         'nama_pemasok' => 'PT. XYZ',
        //         'nama_kontak' => 'Jane Smith',
        //         'nomor_hp' => '9876543210',
        //         'alamat' => 'Jl. XYZ No. 456',
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ]
        // ]);

        $pemasoks = [
            ['nama_pemasok' => 'PT. ABC', 'nama_kontak' => 'John Doe', 'nomor_hp' => '1234567890', 'alamat' => 'Jl. ABC No. 123'],
            ['nama_pemasok' => 'PT. XYZ', 'nama_kontak' => 'Jane Smith', 'nomor_hp' => '9876543210', 'alamat' => 'Jl. XYZ No. 456'],
        ];

        // Gunakan perulangan dan metode create()
        foreach ($pemasoks as $pemasok) {
            Pemasok::create($pemasok);
        }
    }
}
