<?php

namespace App\Filament\Admin\Resources\NomorSuratResource\Pages;

use App\Filament\Admin\Resources\NomorSuratResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNomorSurats extends ListRecords
{
    protected static string $resource = NomorSuratResource::class;

    use ListTrait;
}
