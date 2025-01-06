<?php

namespace App\Filament\Admin\Resources\StatSantriResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\StatSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatSantri extends EditRecord
{
    protected static string $resource = StatSantriResource::class;

    use EditTrait;
}
