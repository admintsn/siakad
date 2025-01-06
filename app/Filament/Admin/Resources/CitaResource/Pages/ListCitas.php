<?php

namespace App\Filament\Admin\Resources\CitaResource\Pages;

use App\Filament\Admin\Resources\CitaResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCitas extends ListRecords
{
    protected static string $resource = CitaResource::class;

    use ListTrait;
}
