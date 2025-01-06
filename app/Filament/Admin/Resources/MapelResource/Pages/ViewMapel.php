<?php

namespace App\Filament\Admin\Resources\MapelResource\Pages;

use App\Filament\Admin\Resources\MapelResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMapel extends ViewRecord
{
    protected static string $resource = MapelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
