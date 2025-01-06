<?php

namespace App\Filament\Admin\Resources\MapelResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\MapelResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMapels extends ListRecords
{
    protected static string $resource = MapelResource::class;

    use ListTrait;
}
