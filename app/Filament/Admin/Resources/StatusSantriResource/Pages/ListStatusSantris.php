<?php

namespace App\Filament\Admin\Resources\StatusSantriResource\Pages;

use App\Filament\Admin\Resources\StatusSantriResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatusSantris extends ListRecords
{
    protected static string $resource = StatusSantriResource::class;

    use ListTrait;
}
