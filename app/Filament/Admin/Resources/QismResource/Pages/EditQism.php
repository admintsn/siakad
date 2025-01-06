<?php

namespace App\Filament\Admin\Resources\QismResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\QismResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditQism extends EditRecord
{
    protected static string $resource = QismResource::class;

    use EditTrait;
}
