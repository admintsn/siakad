<?php

namespace App\Filament\Admin\Resources\WaktutempuhResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\WaktutempuhResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWaktutempuh extends CreateRecord
{
    protected static string $resource = WaktutempuhResource::class;

    use CreateTrait;
}
