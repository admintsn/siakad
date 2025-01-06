<?php

namespace App\Filament\Admin\Resources\UpdateStatusNaikQismResource\Pages;

use App\Filament\Admin\Resources\UpdateStatusNaikQismResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUpdateStatusNaikQism extends ViewRecord
{
    protected static string $resource = UpdateStatusNaikQismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
