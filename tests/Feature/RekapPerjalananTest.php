<?php
use App\Livewire\RekapPerjalanan;
use App\Models\Mak;
use App\Models\Perjalanan;
use Livewire\Livewire;

it('render list components rekap perjalanan', function () {
    Livewire::test(RekapPerjalanan::class)
        ->assertOk();
});

// it('menampilkan Kolom rekap perjalanan', function () {
//     Perjalanan::factory()
//         ->for(
//             Mak::factory()
//             ->state(['kode' => '1'])
//         )
//         ->state([
//             'kode_st' => 'aa.99.99.9a.99.99.9999',
//             'maksud_perjalanan' => 'Operasi Intelijen',
//             'nama_pelaksana' => 'Natsu',
//             'kota_tujuan' => 'Kota Tasikmalaya',
//             'tanggal_berangkat' => '2000-01-01',
//             'uang_harian' => '100000',
//             'uang_transport' => '200000',
//             'total_bayar_spj' => '300000',
//             'status' => '0%',
//             'current_user' => 'Yuuka'
//         ])
//         ->create()
//         ;
//     Perjalanan::factory()
//         ->for(
//             Mak::factory()
//             ->state(['kode' => '2'])
//         )
//         ->state([
//             'kode_st' => 'aa.99.99.9a.99.99.9999',
//             'maksud_perjalanan' => 'Operasi Intelijen',
//             'nama_pelaksana' => 'Yuuka',
//             'kota_tujuan' => 'Kota Bekasi',
//             'tanggal_berangkat' => '2000-01-01',
//             'uang_harian' => '100000',
//             'uang_transport' => '100000',
//             'total_bayar_spj' => '200000',
//             'status' => '25%',
//             'current_user' => 'Yuuka'
//         ])
//         ->create()
//         ;
//     Perjalanan::factory()
//         ->for(
//             Mak::factory()
//             ->state(['kode' => '3'])
//         )
//         ->state([
//             'kode_st' => 'aa.99.99.9a.99.99.9999',
//             'maksud_perjalanan' => 'Operasi Intelijen',
//             'nama_pelaksana' => 'Hanako',
//             'kota_tujuan' => 'Kota Sukabumi',
//             'tanggal_berangkat' => '2000-01-01',
//             'uang_harian' => '100000',
//             'uang_transport' => '100000',
//             'total_bayar_spj' => '200000',
//             'status' => '0%',
//             'current_user' => 'Yuuka'
//         ])
//         ->create()
//         ;

//     Livewire::test(RekapPerjalanan::class)
//         ->assertOk()->assertSeeText([
//             //mak_id, no.ST, maksud perjalanan, nama pelaksana, kota_tujuan, tanggal berangkat,uang harian,uangtransport,total,status, file...
//             '1','aa.99.99.9a.99.99.9999','Operasi Intelijen','Natsu','Kota Tasikmalaya','2000-01-01','100000','200000','300000','0%', 'Yuuka',
//             '2','aa.99.99.9a.99.99.9999','Operasi Intelijen','Yuuka','Kota Bekasi','2000-01-01','100000','100000','200000','25%', 'Yuuka',
//             '3','aa.99.99.9a.99.99.9999','Operasi Intelijen','Hanako','Kota Sukabumi','2000-01-01','100000','100000','200000','0%', 'Yuuka',
//         ]);
// });

it('show the uploaded files', function() {
    $perjalanan = Perjalanan::factory()
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

// dd($perjalanan);

    Livewire::test(RekapPerjalanan::class)
    ->assertOk()->assertSeeText([
        'testDocument1.docx','testDocument2.docx',
        'testDocument3.docx',

    ]);
});
