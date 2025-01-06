<?php

namespace App\Filament\Admin\Resources\PendaftarSantriBaruResource\Pages;

use App\Filament\Admin\Resources\PendaftarSantriBaruResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPendaftarSantriBaru extends ViewRecord
{
    protected static string $resource = PendaftarSantriBaruResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
