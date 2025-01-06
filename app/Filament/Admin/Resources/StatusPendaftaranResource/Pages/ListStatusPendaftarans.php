<?php

namespace App\Filament\Admin\Resources\StatusPendaftaranResource\Pages;

use App\Filament\Admin\Resources\StatusPendaftaranResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatusPendaftarans extends ListRecords
{
    protected static string $resource = StatusPendaftaranResource::class;

    use ListTrait;
}
