<?php

namespace App\Filament\Admin\Resources\JenispfResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\JenispfResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJenispf extends CreateRecord
{
    protected static string $resource = JenispfResource::class;

    use CreateTrait;
}
