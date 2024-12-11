<?php

namespace App\Filament\Admin\Resources\PanelroleResource\Pages;

use App\Filament\Admin\Resources\PanelroleResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditPanelrole extends EditRecord
{
    protected static string $resource = PanelroleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Action::make('Back to List')
                ->url($this->getResource()::getUrl('index')),
        ];
    }
}
