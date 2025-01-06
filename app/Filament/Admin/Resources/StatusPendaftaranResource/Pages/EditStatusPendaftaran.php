<?php

namespace App\Filament\Admin\Resources\StatusPendaftaranResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\StatusPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatusPendaftaran extends EditRecord
{
    protected static string $resource = StatusPendaftaranResource::class;

    use EditTrait;
}
