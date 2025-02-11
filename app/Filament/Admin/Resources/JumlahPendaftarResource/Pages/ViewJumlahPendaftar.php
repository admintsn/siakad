<?php

namespace App\Filament\Admin\Resources\JumlahPendaftarResource\Pages;

use App\Filament\Admin\Resources\JumlahPendaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJumlahPendaftar extends ViewRecord
{
    protected static string $resource = JumlahPendaftarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
