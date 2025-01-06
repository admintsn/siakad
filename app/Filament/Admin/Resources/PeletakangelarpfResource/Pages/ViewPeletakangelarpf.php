<?php

namespace App\Filament\Admin\Resources\PeletakangelarpfResource\Pages;

use App\Filament\Admin\Resources\PeletakangelarpfResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPeletakangelarpf extends ViewRecord
{
    protected static string $resource = PeletakangelarpfResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
