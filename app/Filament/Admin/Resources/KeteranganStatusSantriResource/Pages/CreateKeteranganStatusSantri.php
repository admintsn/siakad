<?php

namespace App\Filament\Admin\Resources\KeteranganStatusSantriResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\KeteranganStatusSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKeteranganStatusSantri extends CreateRecord
{
    protected static string $resource = KeteranganStatusSantriResource::class;

    use CreateTrait;
}
