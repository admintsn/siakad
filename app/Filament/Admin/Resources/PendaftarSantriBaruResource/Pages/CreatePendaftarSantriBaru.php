<?php

namespace App\Filament\Admin\Resources\PendaftarSantriBaruResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\PendaftarSantriBaruResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePendaftarSantriBaru extends CreateRecord
{
    protected static string $resource = PendaftarSantriBaruResource::class;

    use CreateTrait;
}
