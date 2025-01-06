<?php

namespace App\Filament\Admin\Resources\JenisPendaftarResource\Pages;

use App\Filament\Admin\Resources\JenisPendaftarResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisPendaftars extends ListRecords
{
    protected static string $resource = JenisPendaftarResource::class;

    use ListTrait;
}
