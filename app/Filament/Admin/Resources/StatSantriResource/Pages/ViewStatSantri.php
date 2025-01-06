<?php

namespace App\Filament\Admin\Resources\StatSantriResource\Pages;

use App\Filament\Admin\Resources\StatSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatSantri extends ViewRecord
{
    protected static string $resource = StatSantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
