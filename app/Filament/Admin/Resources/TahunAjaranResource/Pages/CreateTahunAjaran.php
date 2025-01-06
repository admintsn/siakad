<?php

namespace App\Filament\Admin\Resources\TahunAjaranResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TahunAjaranResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateTahunAjaran extends CreateRecord
{
    protected static string $resource = TahunAjaranResource::class;

    use CreateTrait;
}
