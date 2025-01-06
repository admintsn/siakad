<?php

namespace App\Filament\Admin\Resources\StatuspfResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatuspfResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatuspf extends CreateRecord
{
    protected static string $resource = StatuspfResource::class;

    use CreateTrait;
}
