<?php

namespace App\Filament\Admin\Resources\MembiayaiSekolahResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\MembiayaiSekolahResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMembiayaiSekolah extends CreateRecord
{
    protected static string $resource = MembiayaiSekolahResource::class;

    use CreateTrait;
}
