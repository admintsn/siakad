<?php

namespace App\Filament\Admin\Resources\JenisPendaftarResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\JenisPendaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisPendaftar extends EditRecord
{
    protected static string $resource = JenisPendaftarResource::class;

    use EditTrait;
}
