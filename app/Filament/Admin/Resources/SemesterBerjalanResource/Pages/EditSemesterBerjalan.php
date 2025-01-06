<?php

namespace App\Filament\Admin\Resources\SemesterBerjalanResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\SemesterBerjalanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSemesterBerjalan extends EditRecord
{
    protected static string $resource = SemesterBerjalanResource::class;

    use EditTrait;
}
