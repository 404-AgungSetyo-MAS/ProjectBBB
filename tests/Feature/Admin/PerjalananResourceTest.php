<?php
use App\Filament\Resources\PerjalananResource;
use App\Models\Mak;
use App\Models\Perjalanan;
use App\Models\User;

use Filament\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteAction as TableDeleteAction;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\get;

beforeEach(function() {
    actingAs(User::factory()->create());
    Storage::fake('files');
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

//akan error jika fileUpload menjadi Multiple

// it('membuat data Perjalanan', function () {
//     $newPerjalanan = Perjalanan::factory()
//         ->for(Mak::factory())
//         ->make();

//     Livewire::test(PerjalananResource\Pages\CreatePerjalanan::class)
//         ->fillForm([
//             'kode_st' => $newPerjalanan->kode_st,
//             'maksud_perjalanan' => $newPerjalanan->maksud_perjalanan,
//             'nama_pelaksana' => $newPerjalanan->nama_pelaksana,
//             'kota_tujuan' => $newPerjalanan->kota_tujuan,
//             'tanggal_berangkat' => $newPerjalanan->tanggal_berangkat,
//             'uang_harian' => $newPerjalanan->uang_harian,
//             'uang_transport' => $newPerjalanan->uang_transport,
//             'total_bayar_spj' => $newPerjalanan->total_bayar_spj,
//             'status' => $newPerjalanan->status,
//             'files' => [$newPerjalanan->files],
//             'current_user' => $newPerjalanan->current_user,
//             'mak_id' => $newPerjalanan->mak->getKey(),
//         ])
//         ->call('create')
//         ->assertHasNoErrors();

//     assertDatabaseHas('perjalanans', [
//         'kode_st' => $newPerjalanan->kode_st,
//         'maksud_perjalanan' => $newPerjalanan->maksud_perjalanan,
//         'nama_pelaksana' => $newPerjalanan->nama_pelaksana,
//         'kota_tujuan' => $newPerjalanan->kota_tujuan,
//         'tanggal_berangkat' => $newPerjalanan->tanggal_berangkat,
//         'uang_harian' => $newPerjalanan->uang_harian,
//         'uang_transport' => $newPerjalanan->uang_transport,
//         'total_bayar_spj' => $newPerjalanan->total_bayar_spj,
//         'status' => $newPerjalanan->status,
//         'files' => json_encode($newPerjalanan->files),
//         'current_user' => $newPerjalanan->current_user,
//         'mak_id' => $newPerjalanan->mak->getKey(),
//     ]);
// });

it('upload document files Perjalanan', function () {
    $newPerjalanan = Perjalanan::factory()
        ->for(Mak::factory())
        ->make();

    $files = UploadedFile::fake()->create('documeme.docx');

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
            'files' => [$files],
            'current_user' => $newPerjalanan->current_user,
            'mak_id' => $newPerjalanan->mak->getKey(),
        ])
        ->call('create')
        ->assertHasNoFormErrors();

            $perjalanan = Perjalanan::first();
            //disk('documents') -> karena filament perjalananresource directorynya diubah
            Storage::disk('documents')->assertExists($perjalanan->files[0]);
});

it('edit data Perjalanan', function () {
    $perjalanan = Perjalanan::factory()
        ->for(Mak::factory())
        ->create();

        get(PerjalananResource::getUrl('edit', ['record' => $perjalanan]))
            ->assertOk();
});

// it('update data Perjalanan', function () {
//     $perjalanan = Perjalanan::factory()
//         ->for(Mak::factory())
//         ->create();

//     $newPerjalanan = Perjalanan::factory()
//         ->for(Mak::factory())
//         ->make();

//     Livewire::test(PerjalananResource\Pages\EditPerjalanan::class, [
//         'record' => $perjalanan->getRouteKey(),
//     ])

//         ->fillForm([
//             'kode_st' => $newPerjalanan->kode_st,
//             'maksud_perjalanan' => $newPerjalanan->maksud_perjalanan,
//             'nama_pelaksana' => $newPerjalanan->nama_pelaksana,
//             'kota_tujuan' => $newPerjalanan->kota_tujuan,
//             'tanggal_berangkat' => $newPerjalanan->tanggal_berangkat,
//             'uang_harian' => $newPerjalanan->uang_harian,
//             'uang_transport' => $newPerjalanan->uang_transport,
//             'total_bayar_spj' => $newPerjalanan->total_bayar_spj,
//             'status' => $newPerjalanan->status,
//             'files' => $newPerjalanan->files,
//             'current_user' => $newPerjalanan->current_user,
//             'mak_id' => $newPerjalanan->mak->getKey(),
//         ])
//         ->call('save')
//         ->assertHasNoFormErrors();

//         expect($perjalanan->refresh())
//             ->mak_id->toBe($newPerjalanan->mak_id)
//             ->kode_st->toBe($newPerjalanan->kode_st)
//             ->nama_pelaksana->toBe($newPerjalanan->nama_pelaksana)
//             ->maksud_perjalanan->toBe($newPerjalanan->maksud_perjalanan)
//             ->kota_tujuan->toBe($newPerjalanan->kota_tujuan)
//             ->tanggal_berangkat->toBe($newPerjalanan->tanggal_berangkat)
//             ->uang_harian->toBe($newPerjalanan->uang_harian)
//             ->uang_transport->toBe($newPerjalanan->uang_transport)
//             ->total_bayar_spj->toBe($newPerjalanan->total_bayar_spj)
//             ->status->toBe($newPerjalanan->status)
//             ->files->toBe([$newPerjalanan->files])
//             ->current_user->toBe($newPerjalanan->current_user);
// });

// it('delete data from EditPerjalanan', function () {
//     $perjalanan = Perjalanan::factory()
//         ->for(Mak::factory())
//         ->create();

//         Livewire::test(PerjalananResource\Pages\EditPerjalanan::class, [
//             'record' => $perjalanan->getRouteKey()
//         ])->callAction(DeleteAction::class);

//         assertModelMissing($perjalanan);
// });

// it('delete data from ListPerjalanan', function () {
//     $perjalanan = Perjalanan::factory()
//         ->for(Mak::factory())
//         ->create();

//         Livewire::test(PerjalananResource\Pages\ListPerjalanans::class)
//         ->callTableAction(TableDeleteAction::class, $perjalanan);

//         $this->assertModelMissing($perjalanan);
// });

it('delete document files from Storage Perjalanan', function () {
    $newPerjalanan = Perjalanan::factory()
        ->for(Mak::factory())
        ->make();

    $files = UploadedFile::fake()->create('document.docx');

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
            'files' => [$files],
            'current_user' => $newPerjalanan->current_user,
            'mak_id' => $newPerjalanan->mak->getKey(),
        ])
        ->call('create');

            $perjalanan = Perjalanan::first();

    Livewire::test(PerjalananResource\Pages\ListPerjalanans::class)
        ->callTableAction(TableDeleteAction::class, $perjalanan);

        Storage::disk('files')->assertMissing($perjalanan->files[0]);
});
