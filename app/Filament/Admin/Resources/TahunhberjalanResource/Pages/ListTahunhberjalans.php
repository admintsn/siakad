<?php

namespace App\Filament\Admin\Resources\TahunhberjalanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TahunhberjalanResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTahunhberjalans extends ListRecords
{
    protected static string $resource = TahunhberjalanResource::class;

    use ListTrait;
}
