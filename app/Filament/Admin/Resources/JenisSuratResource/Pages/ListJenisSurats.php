<?php

namespace App\Filament\Admin\Resources\JenisSuratResource\Pages;

use App\Filament\Admin\Resources\JenisSuratResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisSurats extends ListRecords
{
    protected static string $resource = JenisSuratResource::class;

    use ListTrait;
}
