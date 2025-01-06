<?php

namespace App\Filament\Admin\Resources\AktivitasPendidikanResource\Pages;

use App\Filament\Admin\Resources\AktivitasPendidikanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAktivitasPendidikan extends ViewRecord
{
    protected static string $resource = AktivitasPendidikanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
