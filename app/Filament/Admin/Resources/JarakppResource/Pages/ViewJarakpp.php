<?php

namespace App\Filament\Admin\Resources\JarakppResource\Pages;

use App\Filament\Admin\Resources\JarakppResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJarakpp extends ViewRecord
{
    protected static string $resource = JarakppResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
