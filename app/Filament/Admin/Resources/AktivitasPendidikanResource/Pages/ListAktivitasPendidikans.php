<?php

namespace App\Filament\Admin\Resources\AktivitasPendidikanResource\Pages;

use App\Filament\Admin\Resources\AktivitasPendidikanResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAktivitasPendidikans extends ListRecords
{
    protected static string $resource = AktivitasPendidikanResource::class;

    use ListTrait;
}
