<?php

namespace App\Filament\Admin\Resources\PenghasilanWalisantriResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\PenghasilanWalisantriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenghasilanWalisantri extends CreateRecord
{
    protected static string $resource = PenghasilanWalisantriResource::class;

    use CreateTrait;
}
