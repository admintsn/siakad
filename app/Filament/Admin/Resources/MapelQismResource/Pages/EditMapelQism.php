<?php

namespace App\Filament\Admin\Resources\MapelQismResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\MapelQismResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMapelQism extends EditRecord
{
    protected static string $resource = MapelQismResource::class;

    use EditTrait;
}
