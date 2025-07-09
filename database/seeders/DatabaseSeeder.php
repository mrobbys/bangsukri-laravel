<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RuangSeeder::class);
        $this->call(PemasokSeeder::class);
        $this->call(BarangSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(KaryawanSeeder::class);
        $this->call(BarangMasukSeeder::class);

        // User::factory(10)->create();

        $users = [
            ['name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1'),
            'role' => 'admin'],

            ['name' => 'Robby',
            'username' => 'robby',
            'email' => 'robby@gmail.com',
            'password' => Hash::make('1'),
            'role' => 'user']
        ];

        foreach ($users as $user) {
            User::create($user);
        }
        
        // User::factory()->create([
        //     'name' => 'Robby',
        //     'email' => 'robby@gmail.com',
        //     'password' => Hash::make('1'),
        //     'role' => 'user'
        // ]);
    }
}
