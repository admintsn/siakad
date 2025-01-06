<?php

namespace App\Filament\Admin\Resources\MendaftarKeinginanResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\MendaftarKeinginanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMendaftarKeinginan extends EditRecord
{
    protected static string $resource = MendaftarKeinginanResource::class;

    use EditTrait;
}
