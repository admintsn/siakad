<?php

namespace App\Filament\Admin\Resources\MudirQismResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\MudirQismResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMudirQisms extends ListRecords
{
    protected static string $resource = MudirQismResource::class;

    use ListTrait;
}
