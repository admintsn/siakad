<?php

namespace App\Filament\Admin\Resources\StatuspfResource\Pages;

use App\Filament\Admin\Resources\StatuspfResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatuspf extends ViewRecord
{
    protected static string $resource = StatuspfResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
