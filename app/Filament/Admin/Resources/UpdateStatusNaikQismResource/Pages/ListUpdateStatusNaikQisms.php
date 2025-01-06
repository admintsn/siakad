<?php

namespace App\Filament\Admin\Resources\UpdateStatusNaikQismResource\Pages;

use App\Filament\Admin\Resources\UpdateStatusNaikQismResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUpdateStatusNaikQisms extends ListRecords
{
    protected static string $resource = UpdateStatusNaikQismResource::class;

    use ListTrait;
}
