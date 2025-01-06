<?php

namespace App\Filament\Admin\Resources\StatusSantriResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatusSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatusSantri extends CreateRecord
{
    protected static string $resource = StatusSantriResource::class;

    use CreateTrait;
}
