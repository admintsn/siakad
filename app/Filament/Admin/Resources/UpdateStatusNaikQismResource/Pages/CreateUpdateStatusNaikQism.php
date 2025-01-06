<?php

namespace App\Filament\Admin\Resources\UpdateStatusNaikQismResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\UpdateStatusNaikQismResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUpdateStatusNaikQism extends CreateRecord
{
    protected static string $resource = UpdateStatusNaikQismResource::class;

    use CreateTrait;
}
