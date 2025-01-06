<?php

namespace App\Filament\Admin\Resources\PenghasilanWalisantriResource\Pages;

use App\Filament\Admin\Resources\PenghasilanWalisantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPenghasilanWalisantri extends ViewRecord
{
    protected static string $resource = PenghasilanWalisantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
