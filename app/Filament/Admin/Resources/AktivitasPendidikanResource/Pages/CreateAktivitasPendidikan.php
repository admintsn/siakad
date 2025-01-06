<?php

namespace App\Filament\Admin\Resources\AktivitasPendidikanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\AktivitasPendidikanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAktivitasPendidikan extends CreateRecord
{
    protected static string $resource = AktivitasPendidikanResource::class;

    use CreateTrait;
}
