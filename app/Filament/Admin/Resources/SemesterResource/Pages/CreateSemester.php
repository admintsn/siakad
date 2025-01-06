<?php

namespace App\Filament\Admin\Resources\SemesterResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\SemesterResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateSemester extends CreateRecord
{
    protected static string $resource = SemesterResource::class;

    use CreateTrait;
}
