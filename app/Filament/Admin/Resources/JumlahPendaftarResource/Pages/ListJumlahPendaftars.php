<?php

namespace App\Filament\Admin\Resources\JumlahPendaftarResource\Pages;

use App\Filament\Admin\Resources\JumlahPendaftarResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJumlahPendaftars extends ListRecords
{
    protected static string $resource = JumlahPendaftarResource::class;

    use ListTrait;
}
