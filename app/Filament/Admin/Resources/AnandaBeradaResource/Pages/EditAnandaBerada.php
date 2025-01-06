<?php

namespace App\Filament\Admin\Resources\AnandaBeradaResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\AnandaBeradaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnandaBerada extends EditRecord
{
    protected static string $resource = AnandaBeradaResource::class;

    use EditTrait;
}
