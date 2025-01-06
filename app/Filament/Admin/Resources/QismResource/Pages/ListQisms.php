<?php

namespace App\Filament\Admin\Resources\QismResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\QismResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQisms extends ListRecords
{
    protected static string $resource = QismResource::class;

    use ListTrait;
}
