<?php

namespace App\Filament\Admin\Resources\KeteranganStatusSantriResource\Pages;

use App\Filament\Admin\Resources\KeteranganStatusSantriResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKeteranganStatusSantris extends ListRecords
{
    protected static string $resource = KeteranganStatusSantriResource::class;

    use ListTrait;
}
