<?php

namespace App\Filament\Admin\Resources\MudirQismResource\Pages;

use App\Filament\Admin\Resources\MudirQismResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMudirQism extends ViewRecord
{
    protected static string $resource = MudirQismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
