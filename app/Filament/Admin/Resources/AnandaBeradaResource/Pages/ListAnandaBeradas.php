<?php

namespace App\Filament\Admin\Resources\AnandaBeradaResource\Pages;

use App\Filament\Admin\Resources\AnandaBeradaResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnandaBeradas extends ListRecords
{
    protected static string $resource = AnandaBeradaResource::class;

    use ListTrait;
}
