<?php

namespace App\Filament\Admin\Resources\KewarganegaraanResource\Pages;

use App\Filament\Admin\Resources\KewarganegaraanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKewarganegaraan extends ViewRecord
{
    protected static string $resource = KewarganegaraanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
