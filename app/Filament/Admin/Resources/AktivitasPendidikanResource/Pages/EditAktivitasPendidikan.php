<?php

namespace App\Filament\Admin\Resources\AktivitasPendidikanResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\AktivitasPendidikanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAktivitasPendidikan extends EditRecord
{
    protected static string $resource = AktivitasPendidikanResource::class;

    use EditTrait;
}
