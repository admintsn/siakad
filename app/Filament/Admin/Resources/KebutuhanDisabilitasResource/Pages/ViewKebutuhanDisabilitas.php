<?php

namespace App\Filament\Admin\Resources\KebutuhanDisabilitasResource\Pages;

use App\Filament\Admin\Resources\KebutuhanDisabilitasResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKebutuhanDisabilitas extends ViewRecord
{
    protected static string $resource = KebutuhanDisabilitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
