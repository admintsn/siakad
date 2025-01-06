<?php

namespace App\Filament\Admin\Resources\QismDetailResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\QismDetailResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JoseEspinal\RecordNavigation\Traits\HasRecordsList;

class ListQismDetails extends ListRecords
{
    // use HasRecordsList;

    protected static string $resource = QismDetailResource::class;

    use ListTrait;
}
