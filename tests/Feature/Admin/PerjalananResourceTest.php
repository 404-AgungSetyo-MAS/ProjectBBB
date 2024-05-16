<?php
use App\Filament\Resources\PerjalananResource;
use App\Models\Mak;
use App\Models\Perjalanan;
use App\Models\User;

use Livewire\Livewire;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;

beforeEach(function() {
    actingAs(User::factory()->create());

});

test('render resource pages', function () {
    get(PerjalananResource::getUrl('index'))
    ->assertOk();
});

it('menampilkan list Perjalanan', function () {
    $records = Perjalanan::factory(3)
        ->for(Mak::factory())
        ->create();

    Livewire::test(PerjalananResource\Pages\ListPerjalanans::class)
        ->assertCanSeeTableRecords($records);
});

it('membuat data Perjalanan', function () {
    $newPerjalanan = Perjalanan::factory()
        ->for(Mak::factory())
        ->make();

    Livewire::test(PerjalananResource\Pages\CreatePerjalanan::class)
        ->fillForm([
            'kode_st' => $newPerjalanan->kode_st,
            'maksud_perjalanan' => $newPerjalanan->maksud_perjalanan,
            'nama_pelaksana' => $newPerjalanan->nama_pelaksana,
            'kota_tujuan' => $newPerjalanan->kota_tujuan,
            'tanggal_berangkat' => $newPerjalanan->tanggal_berangkat,
            'uang_harian' => $newPerjalanan->uang_harian,
            'uang_transport' => $newPerjalanan->uang_transport,
            'total_bayar_spj' => $newPerjalanan->total_bayar_spj,
            'status' => $newPerjalanan->status,
            'files' => $newPerjalanan->files,
            'current_user' => $newPerjalanan->current_user,
            'mak_id' => $newPerjalanan->mak->getKey(),
        ])
        ->call('create')
        ->assertHasNoErrors();

    assertDatabaseHas('perjalanans', [
        'kode_st' => $newPerjalanan->kode_st,
        'maksud_perjalanan' => $newPerjalanan->maksud_perjalanan,
        'nama_pelaksana' => $newPerjalanan->nama_pelaksana,
        'kota_tujuan' => $newPerjalanan->kota_tujuan,
        'tanggal_berangkat' => $newPerjalanan->tanggal_berangkat,
        'uang_harian' => $newPerjalanan->uang_harian,
        'uang_transport' => $newPerjalanan->uang_transport,
        'total_bayar_spj' => $newPerjalanan->total_bayar_spj,
        'status' => $newPerjalanan->status,
        'files' => json_encode($newPerjalanan->files),
        'current_user' => $newPerjalanan->current_user,
        'mak_id' => $newPerjalanan->mak->getKey(),
    ]);
});
