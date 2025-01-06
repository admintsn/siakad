<?php

namespace App\Filament\Admin\Resources\LembagaSuratResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\LembagaSuratResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditLembagaSurat extends EditRecord
{
    protected static string $resource = LembagaSuratResource::class;

    use EditTrait;
}
