<?php

namespace App\Filament\Admin\Resources\NismPerTahunResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\NismPerTahunResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateNismPerTahun extends CreateRecord
{
    protected static string $resource = NismPerTahunResource::class;

    use CreateTrait;
}
