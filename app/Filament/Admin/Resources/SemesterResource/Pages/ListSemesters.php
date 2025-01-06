<?php

namespace App\Filament\Admin\Resources\SemesterResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\SemesterResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSemesters extends ListRecords
{
    protected static string $resource = SemesterResource::class;

    use ListTrait;
}
