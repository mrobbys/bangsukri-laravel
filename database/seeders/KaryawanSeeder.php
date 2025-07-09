<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $now = date('Y-m-d H:i:s');
        // Karyawan::insert([
        //     [
        //         'nama_karyawan' => 'Palui',
        //         'nomor_hp' => '08123456789',
        //         'alamat' => 'Martapura',
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ],
        //     [
        //         'nama_karyawan' => 'Gabus',
        //         'nomor_hp' => '08123125389',
        //         'alamat' => 'Banjarmasin',
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ]
        //     ]);

        $karyawans = [
            ['nama_karyawan' => 'Palui', 'nomor_hp' => '08123456789', 'alamat' => 'Martapura', 'jabatan_id' => 1],
            ['nama_karyawan' => 'Gabus', 'nomor_hp' => '08123125389', 'alamat' => 'Banjarmasin' , 'jabatan_id' => 2],
            ['nama_karyawan' => 'Udin', 'nomor_hp' => '08123125483', 'alamat' => 'Banjarbaru' , 'jabatan_id' => 3],
        ];
        // Gunakan perulangan dan metode create() untuk memasukkan data
        foreach ($karyawans as $karyawan) {
            Karyawan::create($karyawan);
        }
    }
}
