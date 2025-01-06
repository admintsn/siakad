<?php

namespace App\Filament\Admin\Resources\StatusWalisantriResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\StatusWalisantriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatusWalisantri extends EditRecord
{
    protected static string $resource = StatusWalisantriResource::class;

    use EditTrait;
}
