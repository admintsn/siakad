<?php

namespace App\Filament\Admin\Resources\GolongandarahResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\GolongandarahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGolongandarah extends EditRecord
{
    protected static string $resource = GolongandarahResource::class;

    use EditTrait;
}
