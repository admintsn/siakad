<?php

namespace App\Filament\Admin\Resources\PendidikanTerakhirWalisantriResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\PendidikanTerakhirWalisantriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePendidikanTerakhirWalisantri extends CreateRecord
{
    protected static string $resource = PendidikanTerakhirWalisantriResource::class;

    use CreateTrait;
}
