<?php

namespace App\Filament\Tsn\Resources\PendaftarNaikQismResource\Pages;

use App\Filament\Tsn\Resources\PendaftarNaikQismResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendaftarNaikQisms extends ListRecords
{
    protected static string $resource = PendaftarNaikQismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}