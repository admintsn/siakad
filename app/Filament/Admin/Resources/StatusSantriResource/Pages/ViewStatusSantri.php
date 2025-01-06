<?php

namespace App\Filament\Admin\Resources\StatusSantriResource\Pages;

use App\Filament\Admin\Resources\StatusSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatusSantri extends ViewRecord
{
    protected static string $resource = StatusSantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
