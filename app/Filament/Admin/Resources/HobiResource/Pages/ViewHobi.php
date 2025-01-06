<?php

namespace App\Filament\Admin\Resources\HobiResource\Pages;

use App\Filament\Admin\Resources\HobiResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHobi extends ViewRecord
{
    protected static string $resource = HobiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
