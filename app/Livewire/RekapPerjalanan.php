<?php

namespace App\Livewire;

use App\Models\Perjalanan;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\View;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class RekapPerjalanan extends Component implements HasForms, HasTable
{
    use InteractsWithTable, InteractsWithForms;

    public Collection $perjalanan;

    public function mount()
    {
        $this->perjalanan = Perjalanan::all();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Perjalanan::query())
            ->columns([
                TextColumn::make('status'),
                TextColumn::make('mak.kode'),
                TextColumn::make('kode_st'),
                TextColumn::make('maksud_perjalanan'),
                TextColumn::make('nama_pelaksana'),
                TextColumn::make('kota_tujuan'),
                TextColumn::make('tanggal_berangkat'),
                TextColumn::make('uang_harian'),
                TextColumn::make('uang_transport'),
                TextColumn::make('total_bayar_spj'),
                TextColumn::make('current_user'),
                TextColumn::make('files'),

                // View::make('perjalanan.table.custom-row-content')
                // ->collapsible(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.rekap-perjalanan');
    }
}
