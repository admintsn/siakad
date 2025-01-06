<?php

namespace App\Filament\Admin\Resources\TahapPendaftaranResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TahapPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTahapPendaftaran extends CreateRecord
{
    protected static string $resource = TahapPendaftaranResource::class;

    use CreateTrait;
}
