<?php

namespace App\Filament\Admin\Resources\StatusWaliResource\Pages;

use App\Filament\Admin\Resources\StatusWaliResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatusWalis extends ListRecords
{
    protected static string $resource = StatusWaliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
