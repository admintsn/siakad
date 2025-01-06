<?php

namespace App\Filament\Admin\Resources\KewarganegaraanResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\KewarganegaraanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKewarganegaraan extends EditRecord
{
    protected static string $resource = KewarganegaraanResource::class;

    use EditTrait;
}
