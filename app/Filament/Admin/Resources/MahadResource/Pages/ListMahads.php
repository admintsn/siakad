<?php

namespace App\Filament\Admin\Resources\MahadResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\MahadResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMahads extends ListRecords
{
    protected static string $resource = MahadResource::class;

    use ListTrait;
}
