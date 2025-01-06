<?php

namespace App\Filament\Admin\Resources\PanelroleResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\PanelroleResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditPanelrole extends EditRecord
{
    protected static string $resource = PanelroleResource::class;

    use EditTrait;
}
