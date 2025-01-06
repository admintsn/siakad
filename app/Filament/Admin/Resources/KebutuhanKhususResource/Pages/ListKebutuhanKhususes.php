<?php

namespace App\Filament\Admin\Resources\KebutuhanKhususResource\Pages;

use App\Filament\Admin\Resources\KebutuhanKhususResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKebutuhanKhususes extends ListRecords
{
    protected static string $resource = KebutuhanKhususResource::class;

    use ListTrait;
}
