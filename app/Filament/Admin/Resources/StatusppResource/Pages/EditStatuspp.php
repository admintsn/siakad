<?php

namespace App\Filament\Admin\Resources\StatusppResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\StatusppResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatuspp extends EditRecord
{
    protected static string $resource = StatusppResource::class;

    use EditTrait;
}
