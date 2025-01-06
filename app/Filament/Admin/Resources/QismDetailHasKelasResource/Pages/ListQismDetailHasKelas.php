<?php

namespace App\Filament\Admin\Resources\QismDetailHasKelasResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\QismDetailHasKelasResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQismDetailHasKelas extends ListRecords
{
    protected static string $resource = QismDetailHasKelasResource::class;

    use ListTrait;
}
