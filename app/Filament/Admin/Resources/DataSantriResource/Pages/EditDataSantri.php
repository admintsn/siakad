<?php

namespace App\Filament\Admin\Resources\DataSantriResource\Pages;

use App\Filament\Admin\Resources\DataSantriResource;
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
