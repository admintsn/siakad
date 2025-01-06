<?php

namespace App\Filament\Admin\Resources\UpdateStatusNaikQismResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\UpdateStatusNaikQismResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUpdateStatusNaikQism extends EditRecord
{
    protected static string $resource = UpdateStatusNaikQismResource::class;

    use EditTrait;
}
