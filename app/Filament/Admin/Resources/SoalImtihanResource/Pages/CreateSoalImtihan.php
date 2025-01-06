<?php

namespace App\Filament\Admin\Resources\SoalImtihanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\SoalImtihanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSoalImtihan extends CreateRecord
{
    protected static string $resource = SoalImtihanResource::class;

    use CreateTrait;
}
