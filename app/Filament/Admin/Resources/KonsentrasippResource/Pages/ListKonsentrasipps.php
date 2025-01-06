<?php

namespace App\Filament\Admin\Resources\KonsentrasippResource\Pages;

use App\Filament\Admin\Resources\KonsentrasippResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKonsentrasipps extends ListRecords
{
    protected static string $resource = KonsentrasippResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
