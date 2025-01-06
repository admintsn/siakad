<?php

namespace App\Filament\Admin\Resources\JarakppResource\Pages;

use App\Filament\Admin\Resources\JarakppResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJarakpps extends ListRecords
{
    protected static string $resource = JarakppResource::class;

    use ListTrait;
}
