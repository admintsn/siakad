<?php

namespace App\Filament\Admin\Resources\PendidikanTerakhirWalisantriResource\Pages;

use App\Filament\Admin\Resources\PendidikanTerakhirWalisantriResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendidikanTerakhirWalisantris extends ListRecords
{
    protected static string $resource = PendidikanTerakhirWalisantriResource::class;

    use ListTrait;
}
