<?php

namespace App\Filament\Admin\Resources\NismPerTahunResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\NismPerTahunResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditNismPerTahun extends EditRecord
{
    protected static string $resource = NismPerTahunResource::class;

    use EditTrait;
}
