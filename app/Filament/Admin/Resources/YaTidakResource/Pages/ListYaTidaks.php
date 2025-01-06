<?php

namespace App\Filament\Admin\Resources\YaTidakResource\Pages;

use App\Filament\Admin\Resources\YaTidakResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListYaTidaks extends ListRecords
{
    protected static string $resource = YaTidakResource::class;

    use ListTrait;
}
