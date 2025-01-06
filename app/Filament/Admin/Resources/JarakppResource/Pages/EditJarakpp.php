<?php

namespace App\Filament\Admin\Resources\JarakppResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\JarakppResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJarakpp extends EditRecord
{
    protected static string $resource = JarakppResource::class;

    use EditTrait;
}
