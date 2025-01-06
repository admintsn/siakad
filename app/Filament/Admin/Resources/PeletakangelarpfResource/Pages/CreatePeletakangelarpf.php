<?php

namespace App\Filament\Admin\Resources\PeletakangelarpfResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\PeletakangelarpfResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePeletakangelarpf extends CreateRecord
{
    protected static string $resource = PeletakangelarpfResource::class;

    use CreateTrait;
}
