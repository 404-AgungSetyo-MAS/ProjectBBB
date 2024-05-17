<?php

namespace App\Filament\Resources\PerjalananResource\Pages;

use App\Filament\Resources\PerjalananResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePerjalanan extends CreateRecord
{
    protected static string $resource = PerjalananResource::class;

    protected function getRedirectUrl(): string
    {
        $resource = static::getResource();

        return $resource::getUrl('index');
    }
}
