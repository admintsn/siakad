<?php

namespace App\Filament\Admin\Resources\PengajarResource\Pages;

use App\Filament\Admin\Resources\PengajarResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPengajar extends ViewRecord
{
    protected static string $resource = PengajarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
