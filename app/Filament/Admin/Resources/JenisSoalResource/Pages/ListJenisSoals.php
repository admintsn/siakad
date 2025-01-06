<?php

namespace App\Filament\Admin\Resources\JenisSoalResource\Pages;

use App\Filament\Admin\Resources\JenisSoalResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisSoals extends ListRecords
{
    protected static string $resource = JenisSoalResource::class;

    use ListTrait;
}
