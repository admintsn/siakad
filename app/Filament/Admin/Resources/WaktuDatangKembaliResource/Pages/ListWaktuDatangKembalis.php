<?php

namespace App\Filament\Admin\Resources\WaktuDatangKembaliResource\Pages;

use App\Filament\Admin\Resources\WaktuDatangKembaliResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWaktuDatangKembalis extends ListRecords
{
    protected static string $resource = WaktuDatangKembaliResource::class;

    use ListTrait;
}
