<?php

namespace App\Filament\Admin\Resources\WaktutempuhResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\WaktutempuhResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWaktutempuh extends EditRecord
{
    protected static string $resource = WaktutempuhResource::class;

    use EditTrait;
}
