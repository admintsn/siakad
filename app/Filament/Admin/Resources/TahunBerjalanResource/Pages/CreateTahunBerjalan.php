<?php

namespace App\Filament\Admin\Resources\TahunBerjalanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TahunBerjalanResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateTahunBerjalan extends CreateRecord
{
    protected static string $resource = TahunBerjalanResource::class;

    use CreateTrait;
}
