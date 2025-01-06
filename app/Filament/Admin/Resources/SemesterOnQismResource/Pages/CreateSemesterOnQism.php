<?php

namespace App\Filament\Admin\Resources\SemesterOnQismResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\SemesterOnQismResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateSemesterOnQism extends CreateRecord
{
    protected static string $resource = SemesterOnQismResource::class;

    use CreateTrait;
}
