<?php

namespace App\Filament\Admin\Resources\MahadResource\Pages;

use App\Filament\Admin\Resources\MahadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMahads extends ListRecords
{
    protected static string $resource = MahadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
