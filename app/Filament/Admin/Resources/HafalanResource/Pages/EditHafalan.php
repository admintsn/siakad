<?php

namespace App\Filament\Admin\Resources\HafalanResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\HafalanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHafalan extends EditRecord
{
    protected static string $resource = HafalanResource::class;

    use EditTrait;
}
