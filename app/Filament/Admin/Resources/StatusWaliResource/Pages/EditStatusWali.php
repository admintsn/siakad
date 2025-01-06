<?php

namespace App\Filament\Admin\Resources\StatusWaliResource\Pages;

use App\Filament\Admin\Resources\StatusWaliResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatusWali extends EditRecord
{
    protected static string $resource = StatusWaliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
