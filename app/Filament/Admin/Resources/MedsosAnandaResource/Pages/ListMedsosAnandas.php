<?php

namespace App\Filament\Admin\Resources\MedsosAnandaResource\Pages;

use App\Filament\Admin\Resources\MedsosAnandaResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedsosAnandas extends ListRecords
{
    protected static string $resource = MedsosAnandaResource::class;

    use ListTrait;
}
