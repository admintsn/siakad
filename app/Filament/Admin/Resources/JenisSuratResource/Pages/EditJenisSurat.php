<?php

namespace App\Filament\Admin\Resources\JenisSuratResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\JenisSuratResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditJenisSurat extends EditRecord
{
    protected static string $resource = JenisSuratResource::class;

    use EditTrait;
}
