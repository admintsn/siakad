<?php

namespace App\Filament\Admin\Resources\QismDetailHasKelasResource\Pages;

use App\Filament\Admin\Resources\QismDetailHasKelasResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQismDetailHasKelas extends ViewRecord
{
    protected static string $resource = QismDetailHasKelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
