<?php

namespace App\Filament\Admin\Resources\KebutuhanKhususResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\KebutuhanKhususResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKebutuhanKhusus extends CreateRecord
{
    protected static string $resource = KebutuhanKhususResource::class;

    use CreateTrait;
}
