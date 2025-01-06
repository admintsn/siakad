<?php

namespace App\Filament\Admin\Resources\KategoriSoalResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\KategoriSoalResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriSoal extends CreateRecord
{
    protected static string $resource = KategoriSoalResource::class;

    use CreateTrait;
}
