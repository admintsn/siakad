<?php

namespace App\Filament\Admin\Resources\TransppResource\Pages;

use App\Filament\Admin\Resources\TransppResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTranspp extends ViewRecord
{
    protected static string $resource = TransppResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
