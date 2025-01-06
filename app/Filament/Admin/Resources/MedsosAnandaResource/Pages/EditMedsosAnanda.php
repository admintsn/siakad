<?php

namespace App\Filament\Admin\Resources\MedsosAnandaResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\MedsosAnandaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedsosAnanda extends EditRecord
{
    protected static string $resource = MedsosAnandaResource::class;

    use EditTrait;
}
