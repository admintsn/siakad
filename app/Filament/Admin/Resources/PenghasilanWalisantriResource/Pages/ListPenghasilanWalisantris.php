<?php

namespace App\Filament\Admin\Resources\PenghasilanWalisantriResource\Pages;

use App\Filament\Admin\Resources\PenghasilanWalisantriResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenghasilanWalisantris extends ListRecords
{
    protected static string $resource = PenghasilanWalisantriResource::class;

    use ListTrait;
}
