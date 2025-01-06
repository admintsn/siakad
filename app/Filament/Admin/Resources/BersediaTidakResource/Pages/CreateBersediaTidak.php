<?php

namespace App\Filament\Admin\Resources\BersediaTidakResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\BersediaTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBersediaTidak extends CreateRecord
{
    protected static string $resource = BersediaTidakResource::class;

    use CreateTrait;

}
