<?php

namespace App\Filament\Admin\Resources\GolongandarahResource\Pages;

use App\Filament\Admin\Resources\GolongandarahResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGolongandarah extends ViewRecord
{
    protected static string $resource = GolongandarahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
