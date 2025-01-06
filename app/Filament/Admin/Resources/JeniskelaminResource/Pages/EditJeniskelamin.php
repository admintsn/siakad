<?php

namespace App\Filament\Admin\Resources\JeniskelaminResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\JeniskelaminResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditJeniskelamin extends EditRecord
{
    protected static string $resource = JeniskelaminResource::class;

    use EditTrait;
}
