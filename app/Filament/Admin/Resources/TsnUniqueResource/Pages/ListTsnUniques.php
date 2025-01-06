<?php

namespace App\Filament\Admin\Resources\TsnUniqueResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TsnUniqueResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTsnUniques extends ListRecords
{
    protected static string $resource = TsnUniqueResource::class;

    use ListTrait;
}
