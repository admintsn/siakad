<?php

namespace App\Filament\Admin\Resources\TahunhberjalanResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TahunhberjalanResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateTahunhberjalan extends CreateRecord
{
    protected static string $resource = TahunhberjalanResource::class;

    use CreateTrait;
}
