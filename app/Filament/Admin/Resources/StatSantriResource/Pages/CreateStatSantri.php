<?php

namespace App\Filament\Admin\Resources\StatSantriResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatSantri extends CreateRecord
{
    protected static string $resource = StatSantriResource::class;

    use CreateTrait;
}
