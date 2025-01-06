<?php

namespace App\Filament\Admin\Resources\BersediaTidakResource\Pages;

use App\Filament\Admin\Resources\BersediaTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBersediaTidak extends ViewRecord
{
    protected static string $resource = BersediaTidakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
