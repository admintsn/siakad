<?php

namespace App\Filament\Admin\Resources\NismPerTahunResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\NismPerTahunResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNismPerTahuns extends ListRecords
{
    protected static string $resource = NismPerTahunResource::class;

    use ListTrait;
}
