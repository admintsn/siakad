<?php

namespace App\Filament\Admin\Resources\WaktutempuhResource\Pages;

use App\Filament\Admin\Resources\WaktutempuhResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWaktutempuh extends ViewRecord
{
    protected static string $resource = WaktutempuhResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
