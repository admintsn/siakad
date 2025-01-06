<?php

namespace App\Filament\Admin\Resources\TahunmberjalanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TahunmberjalanResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateTahunmberjalan extends CreateRecord
{
    protected static string $resource = TahunmberjalanResource::class;

    use CreateTrait;
}
