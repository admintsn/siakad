<?php

namespace App\Filament\Admin\Resources\StatusWalisantriResource\Pages;

use App\Filament\Admin\Resources\StatusWalisantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatusWalisantri extends ViewRecord
{
    protected static string $resource = StatusWalisantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
