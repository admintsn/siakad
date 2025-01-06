<?php

namespace App\Filament\Admin\Resources\GolongandarahResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\GolongandarahResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateGolongandarah extends CreateRecord
{
    protected static string $resource = GolongandarahResource::class;

    use CreateTrait;
}
