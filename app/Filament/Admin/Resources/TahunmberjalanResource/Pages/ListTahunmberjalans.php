<?php

namespace App\Filament\Admin\Resources\TahunmberjalanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TahunmberjalanResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTahunmberjalans extends ListRecords
{
    protected static string $resource = TahunmberjalanResource::class;

    use ListTrait;
}
