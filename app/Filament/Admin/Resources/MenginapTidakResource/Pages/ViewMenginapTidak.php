<?php

namespace App\Filament\Admin\Resources\MenginapTidakResource\Pages;

use App\Filament\Admin\Resources\MenginapTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMenginapTidak extends ViewRecord
{
    protected static string $resource = MenginapTidakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
