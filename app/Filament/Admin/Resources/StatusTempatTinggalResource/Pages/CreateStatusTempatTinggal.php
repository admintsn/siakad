<?php

namespace App\Filament\Admin\Resources\StatusTempatTinggalResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StatusTempatTinggalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatusTempatTinggal extends CreateRecord
{
    protected static string $resource = StatusTempatTinggalResource::class;

    use CreateTrait;
}
