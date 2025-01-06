<?php

namespace App\Filament\Admin\Resources\TsnUniqueResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\TsnUniqueResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditTsnUnique extends EditRecord
{
    protected static string $resource = TsnUniqueResource::class;

    use EditTrait;
}
