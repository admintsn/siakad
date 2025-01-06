<?php

namespace App\Filament\Tsn\Resources\KedatanganSantriResource\Pages;

use App\Filament\Tsn\Resources\KedatanganSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKedatanganSantri extends ViewRecord
{
    protected static string $resource = KedatanganSantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
