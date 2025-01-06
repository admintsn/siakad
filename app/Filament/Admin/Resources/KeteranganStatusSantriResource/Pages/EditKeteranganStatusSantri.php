<?php

namespace App\Filament\Admin\Resources\KeteranganStatusSantriResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\KeteranganStatusSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKeteranganStatusSantri extends EditRecord
{
    protected static string $resource = KeteranganStatusSantriResource::class;

    use EditTrait;
}
