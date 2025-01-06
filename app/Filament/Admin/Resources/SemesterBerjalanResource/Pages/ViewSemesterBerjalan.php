<?php

namespace App\Filament\Admin\Resources\SemesterBerjalanResource\Pages;

use App\Filament\Admin\Resources\SemesterBerjalanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSemesterBerjalan extends ViewRecord
{
    protected static string $resource = SemesterBerjalanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
