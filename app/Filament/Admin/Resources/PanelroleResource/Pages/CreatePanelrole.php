<?php

namespace App\Filament\Admin\Resources\PanelroleResource\Pages;

use App\Filament\Admin\Resources\PanelroleResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreatePanelrole extends CreateRecord
{
    protected static string $resource = PanelroleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Back to List')
                ->url($this->getResource()::getUrl('index')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
