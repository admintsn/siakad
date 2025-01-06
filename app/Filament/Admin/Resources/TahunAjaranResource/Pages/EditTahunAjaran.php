<?php

namespace App\Filament\Admin\Resources\TahunAjaranResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\TahunAjaranResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditTahunAjaran extends EditRecord
{
    protected static string $resource = TahunAjaranResource::class;

    use EditTrait;
}
