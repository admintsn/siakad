<?php

namespace App\Filament\Admin\Resources\TahunmberjalanResource\Pages;

use App\Filament\Admin\Resources\TahunmberjalanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTahunmberjalan extends ViewRecord
{
    protected static string $resource = TahunmberjalanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
