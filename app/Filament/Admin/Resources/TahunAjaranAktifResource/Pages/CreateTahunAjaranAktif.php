<?php

namespace App\Filament\Admin\Resources\TahunAjaranAktifResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TahunAjaranAktifResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateTahunAjaranAktif extends CreateRecord
{
    protected static string $resource = TahunAjaranAktifResource::class;

    use CreateTrait;
}
