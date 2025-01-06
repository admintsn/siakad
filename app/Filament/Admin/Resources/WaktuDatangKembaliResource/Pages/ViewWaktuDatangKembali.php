<?php

namespace App\Filament\Admin\Resources\WaktuDatangKembaliResource\Pages;

use App\Filament\Admin\Resources\WaktuDatangKembaliResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWaktuDatangKembali extends ViewRecord
{
    protected static string $resource = WaktuDatangKembaliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
