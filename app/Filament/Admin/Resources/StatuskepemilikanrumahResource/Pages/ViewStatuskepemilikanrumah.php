<?php

namespace App\Filament\Admin\Resources\StatuskepemilikanrumahResource\Pages;

use App\Filament\Admin\Resources\StatuskepemilikanrumahResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatuskepemilikanrumah extends ViewRecord
{
    protected static string $resource = StatuskepemilikanrumahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
