<?php

namespace App\Filament\Admin\Resources\QismResource\Pages;

use App\Filament\Admin\Resources\QismResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQisms extends ListRecords
{
    protected static string $resource = QismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
