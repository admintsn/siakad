<?php

namespace App\Filament\Admin\Resources\KartuKeluargaSamaDenganResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\KartuKeluargaSamaDenganResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKartuKeluargaSamaDengan extends CreateRecord
{
    protected static string $resource = KartuKeluargaSamaDenganResource::class;

    use CreateTrait;
}
