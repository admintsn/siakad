<?php

namespace App\Filament\Admin\Resources\SemesterOnQismResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\SemesterOnQismResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditSemesterOnQism extends EditRecord
{
    protected static string $resource = SemesterOnQismResource::class;

    use EditTrait;
}
