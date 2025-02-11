<?php

namespace App\Filament\Admin\Resources\JumlahPendaftarResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\JumlahPendaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJumlahPendaftar extends EditRecord
{
    protected static string $resource = JumlahPendaftarResource::class;

    use EditTrait;
}
