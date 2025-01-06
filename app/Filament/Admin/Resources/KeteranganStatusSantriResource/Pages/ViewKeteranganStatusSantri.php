<?php

namespace App\Filament\Admin\Resources\KeteranganStatusSantriResource\Pages;

use App\Filament\Admin\Resources\KeteranganStatusSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKeteranganStatusSantri extends ViewRecord
{
    protected static string $resource = KeteranganStatusSantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
