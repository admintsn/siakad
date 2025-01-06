<?php

namespace App\Filament\Admin\Resources\DataSantriResource\Pages;

use App\Filament\Admin\Resources\DataSantriResource;
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
