<?php

namespace App\Filament\Admin\Resources\JenispfResource\Pages;

use App\Filament\Admin\Resources\JenispfResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenispfs extends ListRecords
{
    protected static string $resource = JenispfResource::class;

    use ListTrait;
}
