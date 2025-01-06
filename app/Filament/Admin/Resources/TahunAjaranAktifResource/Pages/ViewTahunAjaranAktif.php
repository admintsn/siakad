<?php

namespace App\Filament\Admin\Resources\TahunAjaranAktifResource\Pages;

use App\Filament\Admin\Resources\TahunAjaranAktifResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTahunAjaranAktif extends ViewRecord
{
    protected static string $resource = TahunAjaranAktifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
