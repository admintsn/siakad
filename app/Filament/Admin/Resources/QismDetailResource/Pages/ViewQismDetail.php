<?php

namespace App\Filament\Admin\Resources\QismDetailResource\Pages;

use App\Filament\Admin\Resources\QismDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQismDetail extends ViewRecord
{
    protected static string $resource = QismDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
