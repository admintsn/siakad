<?php

namespace App\Filament\Tsn\Resources\NilaiLainnyaResource\Pages;

use App\Filament\Tsn\Resources\NilaiLainnyaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNilaiLainnya extends EditRecord
{
    protected static string $resource = NilaiLainnyaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
