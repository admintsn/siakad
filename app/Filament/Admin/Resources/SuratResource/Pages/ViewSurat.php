<?php

namespace App\Filament\Admin\Resources\SuratResource\Pages;

use App\Filament\Admin\Resources\SuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSurat extends ViewRecord
{
    protected static string $resource = SuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
