<?php

namespace App\Filament\Admin\Resources\MenginapTidakResource\Pages;

use App\Filament\Admin\Resources\MenginapTidakResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenginapTidaks extends ListRecords
{
    protected static string $resource = MenginapTidakResource::class;

    use ListTrait;
}
