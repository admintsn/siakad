<?php

namespace App\Filament\Admin\Resources\PendidikanTerakhirWalisantriResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\PendidikanTerakhirWalisantriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendidikanTerakhirWalisantri extends EditRecord
{
    protected static string $resource = PendidikanTerakhirWalisantriResource::class;

    use EditTrait;
}
