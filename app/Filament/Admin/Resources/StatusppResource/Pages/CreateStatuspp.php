<?php

namespace App\Filament\Admin\Resources\StatusppResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatusppResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatuspp extends CreateRecord
{
    protected static string $resource = StatusppResource::class;

    use CreateTrait;
}
