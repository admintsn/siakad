<?php

namespace App\Filament\Admin\Resources\TransppResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TransppResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTranspps extends ListRecords
{
    protected static string $resource = TransppResource::class;

    use ListTrait;
}
