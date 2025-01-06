<?php

namespace App\Filament\Admin\Resources\CitaResource\Pages;

use App\Filament\Admin\Resources\CitaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCita extends ViewRecord
{
    protected static string $resource = CitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
