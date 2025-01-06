<?php

namespace App\Filament\Admin\Resources\StatuskepemilikanrumahResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatuskepemilikanrumahResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatuskepemilikanrumahs extends ListRecords
{
    protected static string $resource = StatuskepemilikanrumahResource::class;

    use ListTrait;
}
