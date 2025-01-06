<?php

namespace App\Filament\Admin\Resources\SoalImtihanResource\Pages;

use App\Filament\Admin\Resources\SoalImtihanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSoalImtihan extends ViewRecord
{
    protected static string $resource = SoalImtihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
