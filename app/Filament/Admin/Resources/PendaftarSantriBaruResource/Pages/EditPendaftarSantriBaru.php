<?php

namespace App\Filament\Admin\Resources\PendaftarSantriBaruResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\PendaftarSantriBaruResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendaftarSantriBaru extends EditRecord
{
    protected static string $resource = PendaftarSantriBaruResource::class;

    use EditTrait;
}
