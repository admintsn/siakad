<?php

namespace App\Filament\Admin\Resources\StatuskepegawaianResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatuskepegawaianResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatuskepegawaians extends ListRecords
{
    protected static string $resource = StatuskepegawaianResource::class;

    use ListTrait;
}
