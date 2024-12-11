<?php

namespace App\Filament\Admin\Resources\PanelroleResource\Pages;

use App\Filament\Admin\Resources\PanelroleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPanelrole extends ViewRecord
{
    protected static string $resource = PanelroleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
