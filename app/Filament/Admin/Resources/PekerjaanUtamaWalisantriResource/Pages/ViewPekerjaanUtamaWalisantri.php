<?php

namespace App\Filament\Admin\Resources\PekerjaanUtamaWalisantriResource\Pages;

use App\Filament\Admin\Resources\PekerjaanUtamaWalisantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPekerjaanUtamaWalisantri extends ViewRecord
{
    protected static string $resource = PekerjaanUtamaWalisantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
