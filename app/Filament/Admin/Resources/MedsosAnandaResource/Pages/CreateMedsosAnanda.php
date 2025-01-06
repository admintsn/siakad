<?php

namespace App\Filament\Admin\Resources\MedsosAnandaResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\MedsosAnandaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMedsosAnanda extends CreateRecord
{
    protected static string $resource = MedsosAnandaResource::class;

    use CreateTrait;
}
