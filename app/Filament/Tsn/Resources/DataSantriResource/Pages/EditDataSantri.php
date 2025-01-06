<?php

namespace App\Filament\Tsn\Resources\DataSantriResource\Pages;

use App\Filament\Tsn\Resources\DataSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataSantri extends EditRecord
{
    protected static string $resource = DataSantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
