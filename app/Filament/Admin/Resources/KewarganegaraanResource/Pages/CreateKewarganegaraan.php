<?php

namespace App\Filament\Admin\Resources\KewarganegaraanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\KewarganegaraanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKewarganegaraan extends CreateRecord
{
    protected static string $resource = KewarganegaraanResource::class;

    use CreateTrait;
}
