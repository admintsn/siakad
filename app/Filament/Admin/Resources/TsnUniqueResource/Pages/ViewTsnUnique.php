<?php

namespace App\Filament\Admin\Resources\TsnUniqueResource\Pages;

use App\Filament\Admin\Resources\TsnUniqueResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTsnUnique extends ViewRecord
{
    protected static string $resource = TsnUniqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
