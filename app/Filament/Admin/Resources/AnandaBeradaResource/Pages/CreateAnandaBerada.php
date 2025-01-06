<?php

namespace App\Filament\Admin\Resources\AnandaBeradaResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\AnandaBeradaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnandaBerada extends CreateRecord
{
    protected static string $resource = AnandaBeradaResource::class;

    use CreateTrait;
}
