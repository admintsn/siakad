<?php

namespace App\Filament\Admin\Resources\LembagaSuratResource\Pages;

use App\Filament\Admin\Resources\LembagaSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLembagaSurat extends ViewRecord
{
    protected static string $resource = LembagaSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
