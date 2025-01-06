<?php

namespace App\Filament\Admin\Resources\KartuKeluargaSamaDenganResource\Pages;

use App\Filament\Admin\Resources\KartuKeluargaSamaDenganResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKartuKeluargaSamaDengan extends ViewRecord
{
    protected static string $resource = KartuKeluargaSamaDenganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
