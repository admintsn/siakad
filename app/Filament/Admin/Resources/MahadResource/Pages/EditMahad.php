<?php

namespace App\Filament\Admin\Resources\MahadResource\Pages;

use App\Filament\Admin\Resources\MahadResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditMahad extends EditRecord
{
    protected static string $resource = MahadResource::class;

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
