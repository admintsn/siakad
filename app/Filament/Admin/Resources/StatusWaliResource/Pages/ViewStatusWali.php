<?php

namespace App\Filament\Admin\Resources\StatusWaliResource\Pages;

use App\Filament\Admin\Resources\StatusWaliResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatusWali extends ViewRecord
{
    protected static string $resource = StatusWaliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
