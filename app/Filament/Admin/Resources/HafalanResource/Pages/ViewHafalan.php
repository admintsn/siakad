<?php

namespace App\Filament\Admin\Resources\HafalanResource\Pages;

use App\Filament\Admin\Resources\HafalanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHafalan extends ViewRecord
{
    protected static string $resource = HafalanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
