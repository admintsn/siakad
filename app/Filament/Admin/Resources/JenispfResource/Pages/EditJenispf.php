<?php

namespace App\Filament\Admin\Resources\JenispfResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\JenispfResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenispf extends EditRecord
{
    protected static string $resource = JenispfResource::class;

    use EditTrait;
}
