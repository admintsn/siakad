<?php

namespace App\Filament\Admin\Resources\GolongandarahResource\Pages;

use App\Filament\Admin\Resources\GolongandarahResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGolongandarahs extends ListRecords
{
    protected static string $resource = GolongandarahResource::class;

    use ListTrait;
}
