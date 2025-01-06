<?php

namespace App\Filament\Admin\Resources\KelasSantriResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\KelasSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKelasSantri extends CreateRecord
{
    protected static string $resource = KelasSantriResource::class;

    use CreateTrait;
}
