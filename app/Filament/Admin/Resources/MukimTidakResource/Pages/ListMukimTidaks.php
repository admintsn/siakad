<?php

namespace App\Filament\Admin\Resources\MukimTidakResource\Pages;

use App\Filament\Admin\Resources\MukimTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMukimTidaks extends ListRecords
{
    protected static string $resource = MukimTidakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
