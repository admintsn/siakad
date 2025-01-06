<?php

namespace App\Filament\Admin\Resources\PengajarResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\PengajarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePengajar extends CreateRecord
{
    protected static string $resource = PengajarResource::class;

    use CreateTrait;
}
