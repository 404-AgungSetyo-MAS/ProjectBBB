<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerjalananResource\Pages;
use App\Filament\Resources\PerjalananResource\RelationManagers;
use App\Models\Perjalanan;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PerjalananResource extends Resource
{
    protected static ?string $model = Perjalanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mak_id')
                    ->relationship('mak', 'id')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('kode_st')
                    ->maxLength(255)
                    ->placeholder('Contoh : AA.01.09.8A.12.24.1234')
                    ->default(null),
                Forms\Components\TextInput::make('maksud_perjalanan')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('nama_pelaksana')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('kota_tujuan')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('tanggal_berangkat')
                    ->required(),
                Forms\Components\TextInput::make('uang_harian')
                    ->numeric()
                    ->prefix('Rp')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->default(null),
                Forms\Components\TextInput::make('uang_transport')
                    ->numeric()
                    ->prefix('Rp')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->default(null),
                Forms\Components\TextInput::make('total_bayar_spj')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('status')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('current_user')
                    ->required()
                    ->maxLength(255),
                Section::make('Dokumen - Dokumen')
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\FileUpload::make('files')
                            ->multiple()
                            ->preserveFilenames()
                            ->maxSize(2048)
                            ->disk('documents')
                            ->directory('documents')
                            ->enableOpen()
                            ->enableDownload(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mak.kode')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kode_st')
                    ->searchable(),
                Tables\Columns\TextColumn::make('maksud_perjalanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_pelaksana')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kota_tujuan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_berangkat')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('uang_harian')
                    ->numeric()
                    // ->formatStateUsing()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('uang_transport')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_bayar_spj')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    // ->color(fn (string $state): string => match ($state) {
                    //     'Dokumen kosong' => 'gray',
                    //     'Butuh Tanda Tangan' => 'danger',
                    //     'Verifikasi' => 'warning',
                    //     'Dokumen Lengkap' => 'success',
                    // })
                    ->searchable(),
                Tables\Columns\TextColumn::make('current_user')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPerjalanans::route('/'),
            // 'create' => Pages\CreatePerjalanan::route('/create'),
            'edit' => Pages\EditPerjalanan::route('/{record}/edit'),
        ];
    }
}
