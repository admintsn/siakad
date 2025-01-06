<?php

namespace App\Filament\Admin\Resources\YaTidakResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\YaTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditYaTidak extends EditRecord
{
    protected static string $resource = YaTidakResource::class;

    use EditTrait;
}
