<?php

namespace App\Filament\Admin\Resources\MenginapTidakResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\MenginapTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenginapTidak extends EditRecord
{
    protected static string $resource = MenginapTidakResource::class;

    use EditTrait;
}
