<?php

namespace App\Filament\Admin\Resources\TahapPendaftaranResource\Pages;

use App\Filament\Admin\Resources\TahapPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTahapPendaftaran extends ViewRecord
{
    protected static string $resource = TahapPendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
