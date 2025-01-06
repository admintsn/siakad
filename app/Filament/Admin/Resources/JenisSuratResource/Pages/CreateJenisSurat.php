<?php

namespace App\Filament\Admin\Resources\JenisSuratResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\JenisSuratResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisSurat extends CreateRecord
{
    protected static string $resource = JenisSuratResource::class;

    use CreateTrait;
}
