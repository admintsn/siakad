<?php

namespace App\Filament\Admin\Resources\DataKeringananResource\Pages;

use App\Filament\Admin\Resources\DataKeringananResource;
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
