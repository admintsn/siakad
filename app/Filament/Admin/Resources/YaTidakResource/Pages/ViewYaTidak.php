<?php

namespace App\Filament\Admin\Resources\YaTidakResource\Pages;

use App\Filament\Admin\Resources\YaTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewYaTidak extends ViewRecord
{
    protected static string $resource = YaTidakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
