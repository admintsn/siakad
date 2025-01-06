<?php

namespace App\Filament\Admin\Resources\KebutuhanDisabilitasResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\KebutuhanDisabilitasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKebutuhanDisabilitas extends EditRecord
{
    protected static string $resource = KebutuhanDisabilitasResource::class;

    use EditTrait;
}
