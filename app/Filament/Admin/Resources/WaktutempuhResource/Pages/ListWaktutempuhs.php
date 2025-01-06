<?php

namespace App\Filament\Admin\Resources\WaktutempuhResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\WaktutempuhResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWaktutempuhs extends ListRecords
{
    protected static string $resource = WaktutempuhResource::class;

    use ListTrait;
}
