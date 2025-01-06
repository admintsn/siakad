<?php

namespace App\Filament\Admin\Resources\SemesterResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\SemesterResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditSemester extends EditRecord
{
    protected static string $resource = SemesterResource::class;

    use EditTrait;
}
