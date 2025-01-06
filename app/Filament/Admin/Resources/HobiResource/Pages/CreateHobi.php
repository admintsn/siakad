<?php

namespace App\Filament\Admin\Resources\HobiResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\HobiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHobi extends CreateRecord
{
    protected static string $resource = HobiResource::class;

    use CreateTrait;
}
