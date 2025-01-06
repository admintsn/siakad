<?php

namespace App\Filament\Admin\Resources\StatusperkawinanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatusperkawinanResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatusperkawinans extends ListRecords
{
    protected static string $resource = StatusperkawinanResource::class;

    use ListTrait;
}
