<?php

namespace App\Filament\Admin\Resources\MendaftarKeinginanResource\Pages;

use App\Filament\Admin\Resources\MendaftarKeinginanResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMendaftarKeinginans extends ListRecords
{
    protected static string $resource = MendaftarKeinginanResource::class;

    use ListTrait;
}
