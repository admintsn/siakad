<?php

namespace App\Filament\Admin\Resources\TahunhberjalanResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\TahunhberjalanResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditTahunhberjalan extends EditRecord
{
    protected static string $resource = TahunhberjalanResource::class;

    use EditTrait;
}
