<?php

namespace App\Filament\Admin\Resources\StatusAdmPendaftarResource\Pages;

use App\Filament\Admin\Resources\StatusAdmPendaftarResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatusAdmPendaftars extends ListRecords
{
    protected static string $resource = StatusAdmPendaftarResource::class;

    use ListTrait;
}
