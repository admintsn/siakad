<?php

namespace App\Filament\Admin\Resources\LembagaSuratResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\LembagaSuratResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateLembagaSurat extends CreateRecord
{
    protected static string $resource = LembagaSuratResource::class;

    use CreateTrait;
}
