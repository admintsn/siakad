<?php

namespace App\Filament\Admin\Resources\MapelResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\MapelResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateMapel extends CreateRecord
{
    protected static string $resource = MapelResource::class;

    use CreateTrait;
}
