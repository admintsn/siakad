<?php

namespace App\Filament\Admin\Resources\KelasSantriResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\KelasSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKelasSantri extends EditRecord
{
    protected static string $resource = KelasSantriResource::class;

    use EditTrait;
}
