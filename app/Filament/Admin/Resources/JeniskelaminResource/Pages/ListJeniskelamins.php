<?php

namespace App\Filament\Admin\Resources\JeniskelaminResource\Pages;

use App\Filament\Admin\Resources\JeniskelaminResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJeniskelamins extends ListRecords
{
    protected static string $resource = JeniskelaminResource::class;

    use ListTrait;
}
