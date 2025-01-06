<?php

namespace App\Filament\Admin\Resources\CitaResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\CitaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCita extends CreateRecord
{
    protected static string $resource = CitaResource::class;

    use CreateTrait;
}
