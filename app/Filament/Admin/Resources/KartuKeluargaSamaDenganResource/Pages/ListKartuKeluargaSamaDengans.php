<?php

namespace App\Filament\Admin\Resources\KartuKeluargaSamaDenganResource\Pages;

use App\Filament\Admin\Resources\KartuKeluargaSamaDenganResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKartuKeluargaSamaDengans extends ListRecords
{
    protected static string $resource = KartuKeluargaSamaDenganResource::class;

    use ListTrait;
}
