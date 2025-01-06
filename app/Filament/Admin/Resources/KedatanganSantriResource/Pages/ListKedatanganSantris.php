<?php

namespace App\Filament\Admin\Resources\KedatanganSantriResource\Pages;

use App\Filament\Admin\Resources\KedatanganSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKedatanganSantris extends ListRecords
{
    protected static string $resource = KedatanganSantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
