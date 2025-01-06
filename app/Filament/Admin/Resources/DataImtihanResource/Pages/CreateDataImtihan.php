<?php

namespace App\Filament\Admin\Resources\DataImtihanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\DataImtihanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataImtihan extends CreateRecord
{
    protected static string $resource = DataImtihanResource::class;

    use CreateTrait;
}
