<?php

namespace App\Filament\Admin\Resources\StatuskepegawaianResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatuskepegawaianResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateStatuskepegawaian extends CreateRecord
{
    protected static string $resource = StatuskepegawaianResource::class;

    use CreateTrait;
}
