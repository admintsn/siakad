<?php

namespace App\Filament\Admin\Resources\KebutuhanKhususResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\KebutuhanKhususResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKebutuhanKhusus extends EditRecord
{
    protected static string $resource = KebutuhanKhususResource::class;

    use EditTrait;
}
