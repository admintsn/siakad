<?php

namespace App\Filament\Tsn\Resources\SemuaNilaiResource\Pages;

use App\Filament\Tsn\Resources\SemuaNilaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSemuaNilai extends ViewRecord
{
    protected static string $resource = SemuaNilaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
