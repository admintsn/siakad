<?php

namespace App\Filament\Admin\Resources\StatusperkawinanResource\Pages;

use App\Filament\Admin\Resources\StatusperkawinanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatusperkawinan extends ViewRecord
{
    protected static string $resource = StatusperkawinanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
