<?php

namespace App\Filament\Admin\Resources\MahadResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\MahadResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditMahad extends EditRecord
{
    protected static string $resource = MahadResource::class;

    use EditTrait;
}
