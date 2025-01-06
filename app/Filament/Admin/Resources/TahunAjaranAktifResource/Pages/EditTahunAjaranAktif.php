<?php

namespace App\Filament\Admin\Resources\TahunAjaranAktifResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\TahunAjaranAktifResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditTahunAjaranAktif extends EditRecord
{
    protected static string $resource = TahunAjaranAktifResource::class;

    use EditTrait;
}
