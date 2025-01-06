<?php

namespace App\Filament\Admin\Resources\TahunBerjalanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TahunBerjalanResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTahunBerjalans extends ListRecords
{
    protected static string $resource = TahunBerjalanResource::class;

    use ListTrait;
}
