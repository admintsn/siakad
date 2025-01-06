<?php

namespace App\Filament\Admin\Resources\CitaResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\CitaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCita extends EditRecord
{
    protected static string $resource = CitaResource::class;

    use EditTrait;
}
