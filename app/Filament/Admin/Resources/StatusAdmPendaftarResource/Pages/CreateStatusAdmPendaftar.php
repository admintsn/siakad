<?php

namespace App\Filament\Admin\Resources\StatusAdmPendaftarResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatusAdmPendaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatusAdmPendaftar extends CreateRecord
{
    protected static string $resource = StatusAdmPendaftarResource::class;

    use CreateTrait;
}
