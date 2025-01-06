<?php

namespace App\Filament\Admin\Resources\KelasResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\KelasResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateKelas extends CreateRecord
{
    protected static string $resource = KelasResource::class;

    use CreateTrait;
}
