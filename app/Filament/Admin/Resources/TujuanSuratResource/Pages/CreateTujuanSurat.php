<?php

namespace App\Filament\Admin\Resources\TujuanSuratResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TujuanSuratResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateTujuanSurat extends CreateRecord
{
    protected static string $resource = TujuanSuratResource::class;

    use CreateTrait;
}
