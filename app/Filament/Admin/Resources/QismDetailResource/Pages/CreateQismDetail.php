<?php

namespace App\Filament\Admin\Resources\QismDetailResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\QismDetailResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateQismDetail extends CreateRecord
{
    protected static string $resource = QismDetailResource::class;

    use CreateTrait;
}
