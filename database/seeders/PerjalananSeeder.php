<?php

namespace Database\Seeders;

use App\Models\Mak;
use App\Models\Perjalanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerjalananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Perjalanan::factory(5)
        ->for(
            Mak::factory()
            ->state(['kode' => '1'])
        )
        ->state([
            'kode_st' => 'aa.99.99.9a.99.99.9999',
            'maksud_perjalanan' => 'Operasi Intelijen',
            'nama_pelaksana' => 'Natsu',
            'kota_tujuan' => 'Kota Tasikmalaya',
            'tanggal_berangkat' => '2000-01-01',
            'uang_harian' => '100000',
            'uang_transport' => '200000',
            'total_bayar_spj' => '300000',
            'status' => '0%',
            'files' => [
                'testDocument1.docx',
                'testDocument2.docx',
                'testDocument3.docx',
            ],
            'current_user' => 'Yuuka'
        ])
        ->create()
        ;
    }
}
