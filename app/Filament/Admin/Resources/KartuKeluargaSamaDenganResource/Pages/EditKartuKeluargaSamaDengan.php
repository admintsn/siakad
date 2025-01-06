<?php

namespace App\Filament\Admin\Resources\KartuKeluargaSamaDenganResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\KartuKeluargaSamaDenganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKartuKeluargaSamaDengan extends EditRecord
{
    protected static string $resource = KartuKeluargaSamaDenganResource::class;

    use EditTrait;
}
