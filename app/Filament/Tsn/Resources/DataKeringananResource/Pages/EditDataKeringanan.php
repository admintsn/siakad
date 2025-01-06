<?php

namespace App\Filament\Tsn\Resources\DataKeringananResource\Pages;

use App\Filament\Tsn\Resources\DataKeringananResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataKeringanan extends EditRecord
{
    protected static string $resource = DataKeringananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
