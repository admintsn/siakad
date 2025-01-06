<?php

namespace App\Filament\Admin\Resources\KelasSantriResource\Pages;

use App\Filament\Admin\Resources\KelasSantriResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKelasSantris extends ListRecords
{
    protected static string $resource = KelasSantriResource::class;

    use ListTrait;
}
