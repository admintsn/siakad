<?php

namespace App\Filament\Admin\Resources\NomorSuratResource\Pages;

use App\Filament\Admin\Resources\NomorSuratResource;
use App\Filament\Admin\Resources\NomorSuratResource\Widgets\Santri;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNomorSurats extends ListRecords
{
    protected static string $resource = NomorSuratResource::class;

    use ListTrait;

    protected function getHeaderWidgets(): array
    {
        return [
            Santri::class,
        ];
    }
}
