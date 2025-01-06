<?php

namespace App\Filament\Admin\Resources\BersediaTidakResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\BersediaTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBersediaTidak extends EditRecord
{
    protected static string $resource = BersediaTidakResource::class;

    use EditTrait;
}
