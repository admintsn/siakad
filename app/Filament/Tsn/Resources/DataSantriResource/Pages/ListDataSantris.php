<?php

namespace App\Filament\Tsn\Resources\DataSantriResource\Pages;

use App\Filament\Tsn\Resources\DataSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataSantris extends ListRecords
{
    protected static string $resource = DataSantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
