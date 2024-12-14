<?php

namespace App\Filament\Admin\Resources\QismDetailResource\Pages;

use App\Filament\Admin\Resources\QismDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQismDetails extends ListRecords
{
    protected static string $resource = QismDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
