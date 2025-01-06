<?php

namespace App\Filament\Admin\Resources\TahunBerjalanResource\Pages;

use App\Filament\Admin\Resources\TahunBerjalanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTahunBerjalan extends ViewRecord
{
    protected static string $resource = TahunBerjalanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
