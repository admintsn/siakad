<?php

namespace App\Filament\Admin\Resources\MukimTidakResource\Pages;

use App\Filament\Admin\Resources\MukimTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMukimTidak extends EditRecord
{
    protected static string $resource = MukimTidakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
