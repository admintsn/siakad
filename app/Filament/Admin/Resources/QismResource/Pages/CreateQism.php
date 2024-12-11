<?php

namespace App\Filament\Admin\Resources\QismResource\Pages;

use App\Filament\Admin\Resources\QismResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateQism extends CreateRecord
{
    protected static string $resource = QismResource::class;

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
