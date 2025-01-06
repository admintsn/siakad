<?php

namespace App\Filament\Admin\Resources\PeletakangelarpfResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\PeletakangelarpfResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeletakangelarpf extends EditRecord
{
    protected static string $resource = PeletakangelarpfResource::class;

    use EditTrait;
}
