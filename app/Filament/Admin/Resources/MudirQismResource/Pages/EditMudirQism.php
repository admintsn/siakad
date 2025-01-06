<?php

namespace App\Filament\Admin\Resources\MudirQismResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\MudirQismResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditMudirQism extends EditRecord
{
    protected static string $resource = MudirQismResource::class;

    use EditTrait;
}
