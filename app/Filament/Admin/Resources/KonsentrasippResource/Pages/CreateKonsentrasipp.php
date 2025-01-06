<?php

namespace App\Filament\Admin\Resources\KonsentrasippResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\KonsentrasippResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKonsentrasipp extends CreateRecord
{
    protected static string $resource = KonsentrasippResource::class;

    use CreateTrait;
}
