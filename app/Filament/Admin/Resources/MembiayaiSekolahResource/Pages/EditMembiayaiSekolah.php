<?php

namespace App\Filament\Admin\Resources\MembiayaiSekolahResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\MembiayaiSekolahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMembiayaiSekolah extends EditRecord
{
    protected static string $resource = MembiayaiSekolahResource::class;

    use EditTrait;
}
