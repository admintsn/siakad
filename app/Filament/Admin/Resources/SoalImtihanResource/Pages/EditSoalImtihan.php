<?php

namespace App\Filament\Admin\Resources\SoalImtihanResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\SoalImtihanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSoalImtihan extends EditRecord
{
    protected static string $resource = SoalImtihanResource::class;

    use EditTrait;
}
