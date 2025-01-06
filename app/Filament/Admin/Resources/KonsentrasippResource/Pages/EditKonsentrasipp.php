<?php

namespace App\Filament\Admin\Resources\KonsentrasippResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\KonsentrasippResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKonsentrasipp extends EditRecord
{
    protected static string $resource = KonsentrasippResource::class;

    use EditTrait;
}
