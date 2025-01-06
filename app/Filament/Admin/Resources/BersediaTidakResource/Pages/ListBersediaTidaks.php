<?php

namespace App\Filament\Admin\Resources\BersediaTidakResource\Pages;

use App\Filament\Admin\Resources\BersediaTidakResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBersediaTidaks extends ListRecords
{
    protected static string $resource = BersediaTidakResource::class;

    use ListTrait;
}
