<?php

namespace App\Filament\Admin\Resources\StatSantriResource\Pages;

use App\Filament\Admin\Resources\StatSantriResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatSantris extends ListRecords
{
    protected static string $resource = StatSantriResource::class;

    use ListTrait;
}
