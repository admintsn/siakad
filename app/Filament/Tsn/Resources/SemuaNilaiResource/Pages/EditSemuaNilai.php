<?php

namespace App\Filament\Tsn\Resources\SemuaNilaiResource\Pages;

use App\Filament\Tsn\Resources\SemuaNilaiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSemuaNilai extends EditRecord
{
    protected static string $resource = SemuaNilaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
