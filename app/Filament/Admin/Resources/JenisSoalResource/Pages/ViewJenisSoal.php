<?php

namespace App\Filament\Admin\Resources\JenisSoalResource\Pages;

use App\Filament\Admin\Resources\JenisSoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJenisSoal extends ViewRecord
{
    protected static string $resource = JenisSoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
