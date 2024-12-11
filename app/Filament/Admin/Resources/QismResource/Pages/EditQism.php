<?php

namespace App\Filament\Admin\Resources\QismResource\Pages;

use App\Filament\Admin\Resources\QismResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditQism extends EditRecord
{
    protected static string $resource = QismResource::class;

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
