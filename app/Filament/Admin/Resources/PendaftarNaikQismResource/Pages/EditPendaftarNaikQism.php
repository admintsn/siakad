<?php

namespace App\Filament\Admin\Resources\PendaftarNaikQismResource\Pages;

use App\Filament\Admin\Resources\PendaftarNaikQismResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendaftarNaikQism extends EditRecord
{
    protected static string $resource = PendaftarNaikQismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
