<?php

namespace App\Filament\Admin\Resources\StatusWalisantriResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatusWalisantriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatusWalisantri extends CreateRecord
{
    protected static string $resource = StatusWalisantriResource::class;

    use CreateTrait;
}
