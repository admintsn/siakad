<?php

namespace App\Filament\Admin\Resources\WaktuDatangKembaliResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\WaktuDatangKembaliResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWaktuDatangKembali extends EditRecord
{
    protected static string $resource = WaktuDatangKembaliResource::class;

    use EditTrait;
}
