<?php

namespace App\Filament\Admin\Resources\TahapPendaftaranResource\Pages;

use App\Filament\Admin\Resources\TahapPendaftaranResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTahapPendaftarans extends ListRecords
{
    protected static string $resource = TahapPendaftaranResource::class;

    use ListTrait;
}
