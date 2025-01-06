<?php

namespace App\Filament\Admin\Resources\StatusppResource\Pages;

use App\Filament\Admin\Resources\StatusppResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatuspp extends ViewRecord
{
    protected static string $resource = StatusppResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
