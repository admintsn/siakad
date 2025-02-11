<?php

namespace App\Filament\Admin\Resources\SuratResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\SuratResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSurat extends EditRecord
{
    protected static string $resource = SuratResource::class;

    use EditTrait;
}
