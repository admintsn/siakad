<?php

namespace App\Filament\Admin\Resources\KebutuhanDisabilitasResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\KebutuhanDisabilitasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKebutuhanDisabilitas extends CreateRecord
{
    protected static string $resource = KebutuhanDisabilitasResource::class;

    use CreateTrait;
}
