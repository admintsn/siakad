<?php

namespace App\Filament\Admin\Resources\SemesterResource\Pages;

use App\Filament\Admin\Resources\SemesterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSemester extends ViewRecord
{
    protected static string $resource = SemesterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
