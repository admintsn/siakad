<?php

namespace App\Filament\Admin\Resources\PendidikanTerakhirWalisantriResource\Pages;

use App\Filament\Admin\Resources\PendidikanTerakhirWalisantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPendidikanTerakhirWalisantri extends ViewRecord
{
    protected static string $resource = PendidikanTerakhirWalisantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
