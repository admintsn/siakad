<?php

namespace App\Filament\Admin\Resources\TahunAjaranResource\Pages;

use App\Filament\Admin\Resources\TahunAjaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTahunAjaran extends ViewRecord
{
    protected static string $resource = TahunAjaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
