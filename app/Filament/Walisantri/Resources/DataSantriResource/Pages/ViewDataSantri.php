<?php

namespace App\Filament\Walisantri\Resources\DataSantriResource\Pages;

use App\Filament\Walisantri\Resources\DataSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDataSantri extends ViewRecord
{
    protected static string $resource = DataSantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
