<?php

namespace App\Filament\Admin\Resources\MahadResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\MahadResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateMahad extends CreateRecord
{
    protected static string $resource = MahadResource::class;

    use CreateTrait;
}
