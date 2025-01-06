<?php

namespace App\Filament\Admin\Resources\StatusAdmPendaftarResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\StatusAdmPendaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatusAdmPendaftar extends EditRecord
{
    protected static string $resource = StatusAdmPendaftarResource::class;

    use EditTrait;
}
