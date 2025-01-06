<?php

namespace App\Filament\Admin\Resources\StatuskepegawaianResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\StatuskepegawaianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatuskepegawaian extends EditRecord
{
    protected static string $resource = StatuskepegawaianResource::class;

    use EditTrait;
}
