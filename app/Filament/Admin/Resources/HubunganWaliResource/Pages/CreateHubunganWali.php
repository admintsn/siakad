<?php

namespace App\Filament\Admin\Resources\HubunganWaliResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\HubunganWaliResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHubunganWali extends CreateRecord
{
    protected static string $resource = HubunganWaliResource::class;

    use CreateTrait;
}
