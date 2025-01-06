<?php

namespace App\Filament\Admin\Resources\JenisSoalResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\JenisSoalResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditJenisSoal extends EditRecord
{
    protected static string $resource = JenisSoalResource::class;

    use EditTrait;
}
