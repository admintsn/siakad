<?php

namespace App\Filament\Admin\Resources\MedsosAnandaResource\Pages;

use App\Filament\Admin\Resources\MedsosAnandaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMedsosAnanda extends ViewRecord
{
    protected static string $resource = MedsosAnandaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
