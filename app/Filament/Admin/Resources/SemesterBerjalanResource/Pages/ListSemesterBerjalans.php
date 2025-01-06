<?php

namespace App\Filament\Admin\Resources\SemesterBerjalanResource\Pages;

use App\Filament\Admin\Resources\SemesterBerjalanResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSemesterBerjalans extends ListRecords
{
    protected static string $resource = SemesterBerjalanResource::class;

    use ListTrait;
}
