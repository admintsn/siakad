<?php

namespace App\Filament\Admin\Resources\JurusanpfResource\Pages;

use App\Filament\Admin\Resources\JurusanpfResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJurusanpf extends ViewRecord
{
    protected static string $resource = JurusanpfResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
