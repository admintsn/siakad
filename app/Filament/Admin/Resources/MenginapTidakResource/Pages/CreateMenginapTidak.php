<?php

namespace App\Filament\Admin\Resources\MenginapTidakResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\MenginapTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMenginapTidak extends CreateRecord
{
    protected static string $resource = MenginapTidakResource::class;

    use CreateTrait;
}
