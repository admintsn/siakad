<?php

namespace App\Filament\Admin\Resources\StatusTempatTinggalResource\Pages;

use App\Filament\Admin\Resources\StatusTempatTinggalResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatusTempatTinggals extends ListRecords
{
    protected static string $resource = StatusTempatTinggalResource::class;

    use ListTrait;
}
