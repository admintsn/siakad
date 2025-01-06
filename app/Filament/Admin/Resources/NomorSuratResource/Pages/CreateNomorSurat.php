<?php

namespace App\Filament\Admin\Resources\NomorSuratResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\NomorSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNomorSurat extends CreateRecord
{
    protected static string $resource = NomorSuratResource::class;

    use CreateTrait;
}
