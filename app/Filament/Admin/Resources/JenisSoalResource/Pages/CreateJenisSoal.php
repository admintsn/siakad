<?php

namespace App\Filament\Admin\Resources\JenisSoalResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\JenisSoalResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisSoal extends CreateRecord
{
    protected static string $resource = JenisSoalResource::class;

    use CreateTrait;
}
