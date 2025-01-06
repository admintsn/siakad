<?php

namespace App\Filament\Admin\Resources\TujuanSuratResource\Pages;

use App\Filament\Admin\Resources\TujuanSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTujuanSurat extends ViewRecord
{
    protected static string $resource = TujuanSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
