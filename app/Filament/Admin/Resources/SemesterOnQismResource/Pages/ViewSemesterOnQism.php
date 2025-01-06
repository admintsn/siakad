<?php

namespace App\Filament\Admin\Resources\SemesterOnQismResource\Pages;

use App\Filament\Admin\Resources\SemesterOnQismResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSemesterOnQism extends ViewRecord
{
    protected static string $resource = SemesterOnQismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
