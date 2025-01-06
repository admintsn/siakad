<?php

namespace App\Filament\Admin\Resources\KategoriSoalResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\KategoriSoalResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditKategoriSoal extends EditRecord
{
    protected static string $resource = KategoriSoalResource::class;

    use EditTrait;
}
