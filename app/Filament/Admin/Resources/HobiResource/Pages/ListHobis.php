<?php

namespace App\Filament\Admin\Resources\HobiResource\Pages;

use App\Filament\Admin\Resources\HobiResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHobis extends ListRecords
{
    protected static string $resource = HobiResource::class;

    use ListTrait;
}
