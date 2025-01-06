<?php

namespace App\Filament\Admin\Resources\JenisPendaftarResource\Pages;

use App\Filament\Admin\Resources\JenisPendaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJenisPendaftar extends ViewRecord
{
    protected static string $resource = JenisPendaftarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
