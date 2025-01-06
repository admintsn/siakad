<?php

namespace App\Filament\Admin\Resources\TahunBerjalanResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\TahunBerjalanResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditTahunBerjalan extends EditRecord
{
    protected static string $resource = TahunBerjalanResource::class;

    use EditTrait;
}
