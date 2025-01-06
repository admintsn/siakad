<?php

namespace App\Filament\Admin\Resources\StatuskepegawaianResource\Pages;

use App\Filament\Admin\Resources\StatuskepegawaianResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatuskepegawaian extends ViewRecord
{
    protected static string $resource = StatuskepegawaianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
