<?php

namespace App\Filament\Admin\Resources\JurusanpfResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\JurusanpfResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJurusanpf extends EditRecord
{
    protected static string $resource = JurusanpfResource::class;

    use EditTrait;
}
