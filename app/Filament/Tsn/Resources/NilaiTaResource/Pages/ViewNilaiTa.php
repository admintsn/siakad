<?php

namespace App\Filament\Tsn\Resources\NilaiTaResource\Pages;

use App\Filament\Tsn\Resources\NilaiTaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNilaiTa extends ViewRecord
{
    protected static string $resource = NilaiTaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
