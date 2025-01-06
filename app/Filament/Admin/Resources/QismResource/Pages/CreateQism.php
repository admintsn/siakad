<?php

namespace App\Filament\Admin\Resources\QismResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\QismResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateQism extends CreateRecord
{
    protected static string $resource = QismResource::class;

    use CreateTrait;
}
