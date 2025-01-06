<?php

namespace App\Filament\Tsn\Resources\NilaiLainnyaResource\Pages;

use App\Filament\Tsn\Resources\NilaiLainnyaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNilaiLainnya extends ViewRecord
{
    protected static string $resource = NilaiLainnyaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
