<?php

namespace App\Filament\Admin\Resources\PengajarResource\Pages;

use App\Filament\Admin\Resources\PengajarResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengajars extends ListRecords
{
    protected static string $resource = PengajarResource::class;

    use ListTrait;
}
