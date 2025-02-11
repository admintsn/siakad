<?php

namespace App\Filament\Admin\Resources\SuratResource\Pages;

use App\Filament\Admin\Resources\SuratResource;
use App\Filament\Admin\Resources\SuratResource\Widgets\NomorSurat;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSurats extends ListRecords
{
    protected static string $resource = SuratResource::class;

    use ListTrait;

    protected function getFooterWidgets(): array
    {
        return [
            NomorSurat::class,
        ];
    }
}
