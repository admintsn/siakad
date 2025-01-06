<?php

namespace App\Filament\Admin\Resources\SemesterOnQismResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\SemesterOnQismResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSemesterOnQisms extends ListRecords
{
    protected static string $resource = SemesterOnQismResource::class;

    use ListTrait;
}
