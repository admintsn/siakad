<?php

namespace App\Filament\Admin\Resources\JumlahPendaftarResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\JumlahPendaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJumlahPendaftar extends CreateRecord
{
    protected static string $resource = JumlahPendaftarResource::class;

    use CreateTrait;
}
