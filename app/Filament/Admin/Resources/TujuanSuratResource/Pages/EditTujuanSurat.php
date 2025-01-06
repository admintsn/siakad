<?php

namespace App\Filament\Admin\Resources\TujuanSuratResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\TujuanSuratResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditTujuanSurat extends EditRecord
{
    protected static string $resource = TujuanSuratResource::class;

    use EditTrait;
}
