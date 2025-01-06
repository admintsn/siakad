<?php

namespace App\Filament\Admin\Resources\StatusWalisantriResource\Pages;

use App\Filament\Admin\Resources\StatusWalisantriResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatusWalisantris extends ListRecords
{
    protected static string $resource = StatusWalisantriResource::class;

    use ListTrait;
}
