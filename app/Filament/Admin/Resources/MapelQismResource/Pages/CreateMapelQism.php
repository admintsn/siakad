<?php

namespace App\Filament\Admin\Resources\MapelQismResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\MapelQismResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMapelQism extends CreateRecord
{
    protected static string $resource = MapelQismResource::class;

    use CreateTrait;
}
