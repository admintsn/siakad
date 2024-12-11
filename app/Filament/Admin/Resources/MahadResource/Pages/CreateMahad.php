<?php

namespace App\Filament\Admin\Resources\MahadResource\Pages;

use App\Filament\Admin\Resources\MahadResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateMahad extends CreateRecord
{
    protected static string $resource = MahadResource::class;

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
