<?php

namespace App\Filament\Admin\Resources\StatuskepemilikanrumahResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\StatuskepemilikanrumahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatuskepemilikanrumah extends EditRecord
{
    protected static string $resource = StatuskepemilikanrumahResource::class;

    use EditTrait;
}
