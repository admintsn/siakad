<?php

namespace App\Filament\Admin\Resources\JenisSuratResource\Pages;

use App\Filament\Admin\Resources\JenisSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJenisSurat extends ViewRecord
{
    protected static string $resource = JenisSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
