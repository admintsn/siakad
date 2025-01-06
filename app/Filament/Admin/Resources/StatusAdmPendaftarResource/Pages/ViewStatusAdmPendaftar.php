<?php

namespace App\Filament\Admin\Resources\StatusAdmPendaftarResource\Pages;

use App\Filament\Admin\Resources\StatusAdmPendaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatusAdmPendaftar extends ViewRecord
{
    protected static string $resource = StatusAdmPendaftarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
