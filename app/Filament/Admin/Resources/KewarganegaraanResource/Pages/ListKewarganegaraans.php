<?php

namespace App\Filament\Admin\Resources\KewarganegaraanResource\Pages;

use App\Filament\Admin\Resources\KewarganegaraanResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKewarganegaraans extends ListRecords
{
    protected static string $resource = KewarganegaraanResource::class;

    use ListTrait;
}
