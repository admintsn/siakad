<?php

namespace App\Filament\Admin\Resources\PekerjaanUtamaWalisantriResource\Pages;

use App\Filament\Admin\Resources\PekerjaanUtamaWalisantriResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPekerjaanUtamaWalisantris extends ListRecords
{
    protected static string $resource = PekerjaanUtamaWalisantriResource::class;

    use ListTrait;
}
