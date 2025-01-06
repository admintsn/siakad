<?php

namespace App\Filament\Admin\Resources\NomorSuratResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\NomorSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNomorSurat extends EditRecord
{
    protected static string $resource = NomorSuratResource::class;

    use EditTrait;
}
