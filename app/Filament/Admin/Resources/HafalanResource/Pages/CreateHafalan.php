<?php

namespace App\Filament\Admin\Resources\HafalanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\HafalanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHafalan extends CreateRecord
{
    protected static string $resource = HafalanResource::class;

    use CreateTrait;
}
