<?php

namespace App\Filament\Tsn\Resources\DataKeringananResource\Pages;

use App\Filament\Tsn\Resources\DataKeringananResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataKeringanans extends ListRecords
{
    protected static string $resource = DataKeringananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
