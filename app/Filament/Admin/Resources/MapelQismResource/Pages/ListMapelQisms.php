<?php

namespace App\Filament\Admin\Resources\MapelQismResource\Pages;

use App\Filament\Admin\Resources\MapelQismResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMapelQisms extends ListRecords
{
    protected static string $resource = MapelQismResource::class;

    use ListTrait;
}
