<?php

namespace App\Filament\Admin\Resources\TahunAjaranAktifResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TahunAjaranAktifResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTahunAjaranAktifs extends ListRecords
{
    protected static string $resource = TahunAjaranAktifResource::class;

    use ListTrait;
}
