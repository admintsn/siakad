<?php

namespace App\Filament\Admin\Resources\StatusPendaftaranResource\Pages;

use App\Filament\Admin\Resources\StatusPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatusPendaftaran extends ViewRecord
{
    protected static string $resource = StatusPendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
