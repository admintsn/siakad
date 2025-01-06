<?php

namespace App\Filament\Admin\Resources\MapelResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\MapelResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditMapel extends EditRecord
{
    protected static string $resource = MapelResource::class;

    use EditTrait;
}
