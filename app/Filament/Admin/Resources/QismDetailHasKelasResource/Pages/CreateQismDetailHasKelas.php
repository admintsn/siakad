<?php

namespace App\Filament\Admin\Resources\QismDetailHasKelasResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\QismDetailHasKelasResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateQismDetailHasKelas extends CreateRecord
{
    protected static string $resource = QismDetailHasKelasResource::class;

    use CreateTrait;
}
