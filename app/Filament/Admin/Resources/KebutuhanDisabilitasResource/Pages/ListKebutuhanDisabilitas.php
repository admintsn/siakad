<?php

namespace App\Filament\Admin\Resources\KebutuhanDisabilitasResource\Pages;

use App\Filament\Admin\Resources\KebutuhanDisabilitasResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKebutuhanDisabilitas extends ListRecords
{
    protected static string $resource = KebutuhanDisabilitasResource::class;

    use ListTrait;
}
