<?php

namespace App\Filament\Admin\Resources\QismDetailResource\Pages;

use App\Filament\Admin\Resources\QismDetailResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditQismDetail extends EditRecord
{
    protected static string $resource = QismDetailResource::class;

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
