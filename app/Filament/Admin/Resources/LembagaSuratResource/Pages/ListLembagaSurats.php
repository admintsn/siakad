<?php

namespace App\Filament\Admin\Resources\LembagaSuratResource\Pages;

use App\Filament\Admin\Resources\LembagaSuratResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLembagaSurats extends ListRecords
{
    protected static string $resource = LembagaSuratResource::class;

    use ListTrait;
}
