<?php

namespace App\Filament\Admin\Resources\JumlahSantriResource\Pages;

use App\Filament\Admin\Resources\JumlahSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJumlahSantri extends ViewRecord
{
    protected static string $resource = JumlahSantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
