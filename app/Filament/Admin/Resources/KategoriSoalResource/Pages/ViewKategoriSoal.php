<?php

namespace App\Filament\Admin\Resources\KategoriSoalResource\Pages;

use App\Filament\Admin\Resources\KategoriSoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKategoriSoal extends ViewRecord
{
    protected static string $resource = KategoriSoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
