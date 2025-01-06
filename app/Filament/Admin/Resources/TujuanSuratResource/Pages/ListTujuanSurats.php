<?php

namespace App\Filament\Admin\Resources\TujuanSuratResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TujuanSuratResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTujuanSurats extends ListRecords
{
    protected static string $resource = TujuanSuratResource::class;

    use ListTrait;
}
