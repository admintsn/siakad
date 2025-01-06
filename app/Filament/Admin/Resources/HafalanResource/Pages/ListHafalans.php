<?php

namespace App\Filament\Admin\Resources\HafalanResource\Pages;

use App\Filament\Admin\Resources\HafalanResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHafalans extends ListRecords
{
    protected static string $resource = HafalanResource::class;

    use ListTrait;
}
