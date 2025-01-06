<?php

namespace App\Filament\Admin\Resources\TahunhberjalanResource\Pages;

use App\Filament\Admin\Resources\TahunhberjalanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTahunhberjalan extends ViewRecord
{
    protected static string $resource = TahunhberjalanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
