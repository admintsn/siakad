<?php

namespace App\Filament\Admin\Resources\JenisPendaftarResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\JenisPendaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisPendaftar extends CreateRecord
{
    protected static string $resource = JenisPendaftarResource::class;

    use CreateTrait;
}
