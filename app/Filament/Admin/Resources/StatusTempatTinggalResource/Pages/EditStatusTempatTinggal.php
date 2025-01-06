<?php

namespace App\Filament\Admin\Resources\StatusTempatTinggalResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\StatusTempatTinggalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatusTempatTinggal extends EditRecord
{
    protected static string $resource = StatusTempatTinggalResource::class;

    use EditTrait;
}
