<?php

namespace App\Filament\Admin\Resources\TahapPendaftaranResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\TahapPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTahapPendaftaran extends EditRecord
{
    protected static string $resource = TahapPendaftaranResource::class;

    use EditTrait;
}
