<?php

namespace App\Filament\Admin\Resources\TahunmberjalanResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\TahunmberjalanResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditTahunmberjalan extends EditRecord
{
    protected static string $resource = TahunmberjalanResource::class;

    use EditTrait;
}
