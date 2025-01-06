<?php

namespace App\Filament\Admin\Resources\KelasSantriResource\Pages;

use App\Filament\Admin\Resources\KelasSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKelasSantri extends ViewRecord
{
    protected static string $resource = KelasSantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
