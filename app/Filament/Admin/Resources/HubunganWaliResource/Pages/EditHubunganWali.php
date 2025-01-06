<?php

namespace App\Filament\Admin\Resources\HubunganWaliResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\HubunganWaliResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHubunganWali extends EditRecord
{
    protected static string $resource = HubunganWaliResource::class;

    use EditTrait;
}
