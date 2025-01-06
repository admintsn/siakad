<?php

namespace App\Filament\Admin\Resources\DataImtihanResource\Pages;

use App\Filament\Admin\Resources\DataImtihanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDataImtihan extends ViewRecord
{
    protected static string $resource = DataImtihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
