<?php

namespace App\Filament\Admin\Resources\JeniskelaminResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\JeniskelaminResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateJeniskelamin extends CreateRecord
{
    protected static string $resource = JeniskelaminResource::class;

    use CreateTrait;
}
