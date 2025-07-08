<?php

namespace Database\Seeders;

use App\Models\Ruang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $now = date('Y-m-d H:i:s');
        // Ruang::insert([
        //     [
        //         'nama_ruang' => 'Front Office',
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ],
        //     [
        //         'nama_ruang' => 'Marketing',
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ],
        //     [
        //         'nama_ruang' => 'Finance',
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ]
        // ]);

        // Siapkan data dalam sebuah array
        $ruangs = [
            ['nama_ruang' => 'Front Office'],
            ['nama_ruang' => 'Marketing'],
            ['nama_ruang' => 'Finance'],
        ];

        // Gunakan perulangan dan metode create()
        foreach ($ruangs as $ruang) {
            Ruang::create($ruang);
        }
    }
}
