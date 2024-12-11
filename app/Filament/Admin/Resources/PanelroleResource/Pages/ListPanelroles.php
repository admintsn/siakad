<?php

namespace App\Filament\Admin\Resources\PanelroleResource\Pages;

use App\Filament\Admin\Resources\PanelroleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPanelroles extends ListRecords
{
    protected static string $resource = PanelroleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
