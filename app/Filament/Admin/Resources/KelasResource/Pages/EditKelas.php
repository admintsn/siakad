<?php

namespace App\Filament\Admin\Resources\KelasResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\KelasResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditKelas extends EditRecord
{
    protected static string $resource = KelasResource::class;

    use EditTrait;
}
