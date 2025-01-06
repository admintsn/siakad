<?php

namespace App\Filament\Admin\Resources\AnandaBeradaResource\Pages;

use App\Filament\Admin\Resources\AnandaBeradaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAnandaBerada extends ViewRecord
{
    protected static string $resource = AnandaBeradaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
