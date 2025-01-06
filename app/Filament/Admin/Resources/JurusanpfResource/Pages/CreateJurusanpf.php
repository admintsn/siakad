<?php

namespace App\Filament\Admin\Resources\JurusanpfResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\JurusanpfResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJurusanpf extends CreateRecord
{
    protected static string $resource = JurusanpfResource::class;

    use CreateTrait;
}
