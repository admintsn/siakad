<?php

namespace App\Filament\Admin\Resources\MendaftarKeinginanResource\Pages;

use App\Filament\Admin\Resources\MendaftarKeinginanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMendaftarKeinginan extends ViewRecord
{
    protected static string $resource = MendaftarKeinginanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
