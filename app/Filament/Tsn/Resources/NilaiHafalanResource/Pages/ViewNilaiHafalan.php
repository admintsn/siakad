<?php

namespace App\Filament\Tsn\Resources\NilaiHafalanResource\Pages;

use App\Filament\Tsn\Resources\NilaiHafalanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNilaiHafalan extends ViewRecord
{
    protected static string $resource = NilaiHafalanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
