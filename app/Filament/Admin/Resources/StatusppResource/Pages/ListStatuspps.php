<?php

namespace App\Filament\Admin\Resources\StatusppResource\Pages;

use App\Filament\Admin\Resources\StatusppResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatuspps extends ListRecords
{
    protected static string $resource = StatusppResource::class;

    use ListTrait;
}
