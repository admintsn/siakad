<?php

namespace App\Filament\Admin\Resources\HubunganWaliResource\Pages;

use App\Filament\Admin\Resources\HubunganWaliResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHubunganWalis extends ListRecords
{
    protected static string $resource = HubunganWaliResource::class;

    use ListTrait;
}
