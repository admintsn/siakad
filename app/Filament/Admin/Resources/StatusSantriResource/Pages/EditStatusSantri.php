<?php

namespace App\Filament\Admin\Resources\StatusSantriResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\StatusSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatusSantri extends EditRecord
{
    protected static string $resource = StatusSantriResource::class;

    use EditTrait;
}
