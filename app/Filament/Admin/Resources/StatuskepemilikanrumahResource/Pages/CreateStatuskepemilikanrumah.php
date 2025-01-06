<?php

namespace App\Filament\Admin\Resources\StatuskepemilikanrumahResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatuskepemilikanrumahResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateStatuskepemilikanrumah extends CreateRecord
{
    protected static string $resource = StatuskepemilikanrumahResource::class;

    use CreateTrait;
}
