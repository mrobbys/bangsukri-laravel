<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatans = [
            ['nama_jabatan' => 'Direktur'],
            ['nama_jabatan' => 'Manager'],
            ['nama_jabatan' => 'Karyawan'],
        ];

        // Gunakan perulangan dan metode create() untuk memasukkan data
        foreach ($jabatans as $jabatan) {
            Jabatan::create($jabatan);
        }
    }
}
