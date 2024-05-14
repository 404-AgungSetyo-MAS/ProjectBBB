<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perjalanan>
 */
class PerjalananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'mak' => fake()->word(),
            'kode_st' => fake()->word(),
            'maksud_perjalanan' => fake()->word(),
            'nama_pelaksana' => fake()->word(),
            'kota_tujuan' => fake()->word(),
            'tanggal_berangkat' => fake()->date(),
            'uang_harian' => fake()->numberBetween(1000, 1000000),
            'uang_transport' => fake()->numberBetween(1000, 1000000),
            'total_bayar_spj' => fake()->word(),
            'status' => fake()->numberBetween(0,100),
            'files' => fake()->word(),
            'current_user' => fake()->name(),
        ];
    }
}
