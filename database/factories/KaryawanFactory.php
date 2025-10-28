<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_karyawan' => fake()->name(),
            'nomor_hp' => fake()->phoneNumber(),
            'alamat' => fake()->address(),
            'jabatan_id' => fake()->numberBetween(1, 3),
        ];
    }
}
