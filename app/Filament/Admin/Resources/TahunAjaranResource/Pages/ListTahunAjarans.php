<?php

namespace App\Filament\Admin\Resources\TahunAjaranResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TahunAjaranResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTahunAjarans extends ListRecords
{
    protected static string $resource = TahunAjaranResource::class;

    use ListTrait;
}
