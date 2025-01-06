<?php

namespace App\Filament\Admin\Resources\MembiayaiSekolahResource\Pages;

use App\Filament\Admin\Resources\MembiayaiSekolahResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMembiayaiSekolahs extends ListRecords
{
    protected static string $resource = MembiayaiSekolahResource::class;

    use ListTrait;
}
