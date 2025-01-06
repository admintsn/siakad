<?php

namespace App\Filament\Admin\Resources\JurusanpfResource\Pages;

use App\Filament\Admin\Resources\JurusanpfResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJurusanpfs extends ListRecords
{
    protected static string $resource = JurusanpfResource::class;

    use ListTrait;
}
