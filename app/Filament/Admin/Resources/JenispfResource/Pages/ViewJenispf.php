<?php

namespace App\Filament\Admin\Resources\JenispfResource\Pages;

use App\Filament\Admin\Resources\JenispfResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJenispf extends ViewRecord
{
    protected static string $resource = JenispfResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
