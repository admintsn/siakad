<?php

namespace App\Filament\Admin\Resources\StatusperkawinanResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\StatusperkawinanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatusperkawinan extends EditRecord
{
    protected static string $resource = StatusperkawinanResource::class;

    use EditTrait;
}
