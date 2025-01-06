<?php

namespace App\Filament\Admin\Resources\StatusperkawinanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatusperkawinanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatusperkawinan extends CreateRecord
{
    protected static string $resource = StatusperkawinanResource::class;

    use CreateTrait;
}
