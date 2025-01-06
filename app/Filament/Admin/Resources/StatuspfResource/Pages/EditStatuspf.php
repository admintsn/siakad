<?php

namespace App\Filament\Admin\Resources\StatuspfResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\StatuspfResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatuspf extends EditRecord
{
    protected static string $resource = StatuspfResource::class;

    use EditTrait;
}
