<?php

namespace App\Filament\Admin\Resources\MembiayaiSekolahResource\Pages;

use App\Filament\Admin\Resources\MembiayaiSekolahResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMembiayaiSekolah extends ViewRecord
{
    protected static string $resource = MembiayaiSekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
