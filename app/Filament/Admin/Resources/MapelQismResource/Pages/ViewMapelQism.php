<?php

namespace App\Filament\Admin\Resources\MapelQismResource\Pages;

use App\Filament\Admin\Resources\MapelQismResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMapelQism extends ViewRecord
{
    protected static string $resource = MapelQismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
