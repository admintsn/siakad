<?php

namespace App\Filament\Admin\Resources\PekerjaanUtamaWalisantriResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\PekerjaanUtamaWalisantriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePekerjaanUtamaWalisantri extends CreateRecord
{
    protected static string $resource = PekerjaanUtamaWalisantriResource::class;

    use CreateTrait;
}
