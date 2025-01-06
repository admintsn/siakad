<?php

namespace App\Filament\Admin\Resources\NomorSuratResource\Pages;

use App\Filament\Admin\Resources\NomorSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNomorSurat extends ViewRecord
{
    protected static string $resource = NomorSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
