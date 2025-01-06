<?php

namespace App\Filament\Admin\Resources\KonsentrasippResource\Pages;

use App\Filament\Admin\Resources\KonsentrasippResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKonsentrasipp extends ViewRecord
{
    protected static string $resource = KonsentrasippResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
