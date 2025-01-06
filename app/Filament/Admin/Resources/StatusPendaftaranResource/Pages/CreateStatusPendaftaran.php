<?php

namespace App\Filament\Admin\Resources\StatusPendaftaranResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatusPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatusPendaftaran extends CreateRecord
{
    protected static string $resource = StatusPendaftaranResource::class;

    use CreateTrait;
}
