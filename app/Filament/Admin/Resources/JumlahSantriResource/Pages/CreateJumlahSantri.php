<?php

namespace App\Filament\Admin\Resources\JumlahSantriResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\JumlahSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJumlahSantri extends CreateRecord
{
    protected static string $resource = JumlahSantriResource::class;

    use CreateTrait;
}
