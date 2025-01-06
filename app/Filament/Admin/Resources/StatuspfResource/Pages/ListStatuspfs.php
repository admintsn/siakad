<?php

namespace App\Filament\Admin\Resources\StatuspfResource\Pages;

use App\Filament\Admin\Resources\StatuspfResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatuspfs extends ListRecords
{
    protected static string $resource = StatuspfResource::class;

    use ListTrait;
}
