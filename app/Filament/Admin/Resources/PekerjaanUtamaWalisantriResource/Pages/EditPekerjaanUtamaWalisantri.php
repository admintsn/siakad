<?php

namespace App\Filament\Admin\Resources\PekerjaanUtamaWalisantriResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\PekerjaanUtamaWalisantriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPekerjaanUtamaWalisantri extends EditRecord
{
    protected static string $resource = PekerjaanUtamaWalisantriResource::class;

    use EditTrait;
}
