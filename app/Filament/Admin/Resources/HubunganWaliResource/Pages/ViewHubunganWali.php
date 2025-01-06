<?php

namespace App\Filament\Admin\Resources\HubunganWaliResource\Pages;

use App\Filament\Admin\Resources\HubunganWaliResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHubunganWali extends ViewRecord
{
    protected static string $resource = HubunganWaliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
