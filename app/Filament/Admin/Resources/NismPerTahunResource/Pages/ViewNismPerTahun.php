<?php

namespace App\Filament\Admin\Resources\NismPerTahunResource\Pages;

use App\Filament\Admin\Resources\NismPerTahunResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNismPerTahun extends ViewRecord
{
    protected static string $resource = NismPerTahunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
