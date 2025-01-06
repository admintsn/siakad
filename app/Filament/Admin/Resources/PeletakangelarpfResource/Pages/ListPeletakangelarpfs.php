<?php

namespace App\Filament\Admin\Resources\PeletakangelarpfResource\Pages;

use App\Filament\Admin\Resources\PeletakangelarpfResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeletakangelarpfs extends ListRecords
{
    protected static string $resource = PeletakangelarpfResource::class;

    use ListTrait;
}
