<?php

namespace App\Filament\Admin\Resources\YaTidakResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\YaTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateYaTidak extends CreateRecord
{
    protected static string $resource = YaTidakResource::class;

    use CreateTrait;
}
