<?php

namespace App\Filament\Admin\Resources\QismDetailResource\Pages;

use App\Filament\Admin\Resources\QismDetailResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateQismDetail extends CreateRecord
{
    protected static string $resource = QismDetailResource::class;

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
