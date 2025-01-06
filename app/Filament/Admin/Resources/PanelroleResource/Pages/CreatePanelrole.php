<?php

namespace App\Filament\Admin\Resources\PanelroleResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\PanelroleResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreatePanelrole extends CreateRecord
{
    protected static string $resource = PanelroleResource::class;

    use CreateTrait;
}
