<?php

namespace App\Filament\Walisantri\Resources\DataSantriResource\Pages;

use App\Filament\Walisantri\Resources\DataSantriResource;
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
