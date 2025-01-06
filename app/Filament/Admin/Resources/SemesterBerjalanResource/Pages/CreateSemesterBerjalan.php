<?php

namespace App\Filament\Admin\Resources\SemesterBerjalanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\SemesterBerjalanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSemesterBerjalan extends CreateRecord
{
    protected static string $resource = SemesterBerjalanResource::class;

    use CreateTrait;
}
