<?php

namespace App\Filament\Admin\Resources\PenghasilanWalisantriResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\PenghasilanWalisantriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenghasilanWalisantri extends EditRecord
{
    protected static string $resource = PenghasilanWalisantriResource::class;

    use EditTrait;
}
