<?php

namespace App\Filament\Admin\Resources\KategoriSoalResource\Pages;

use App\Filament\Admin\Resources\KategoriSoalResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriSoals extends ListRecords
{
    protected static string $resource = KategoriSoalResource::class;

    use ListTrait;
}
