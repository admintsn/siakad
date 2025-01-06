<?php

namespace App\Filament\Admin\Resources\MendaftarKeinginanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\MendaftarKeinginanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMendaftarKeinginan extends CreateRecord
{
    protected static string $resource = MendaftarKeinginanResource::class;

    use CreateTrait;
}
