<?php

namespace App\Filament\Admin\Resources\WaktuDatangKembaliResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\WaktuDatangKembaliResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWaktuDatangKembali extends CreateRecord
{
    protected static string $resource = WaktuDatangKembaliResource::class;

    use CreateTrait;
}
