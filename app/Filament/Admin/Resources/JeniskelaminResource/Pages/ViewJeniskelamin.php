<?php

namespace App\Filament\Admin\Resources\JeniskelaminResource\Pages;

use App\Filament\Admin\Resources\JeniskelaminResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJeniskelamin extends ViewRecord
{
    protected static string $resource = JeniskelaminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
