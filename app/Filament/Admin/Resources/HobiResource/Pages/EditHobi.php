<?php

namespace App\Filament\Admin\Resources\HobiResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\HobiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHobi extends EditRecord
{
    protected static string $resource = HobiResource::class;

    use EditTrait;
}
