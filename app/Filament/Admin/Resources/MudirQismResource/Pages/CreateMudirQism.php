<?php

namespace App\Filament\Admin\Resources\MudirQismResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\MudirQismResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateMudirQism extends CreateRecord
{
    protected static string $resource = MudirQismResource::class;

    use CreateTrait;
}
