<?php

namespace App\Filament\Admin\Resources\QismDetailResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\QismDetailResource;
use App\Filament\Admin\Resources\QismDetailResource\RelationManagers\MapelsRelationManager;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Guava\FilamentModalRelationManagers\Actions\Action\RelationManagerAction;
use JoseEspinal\RecordNavigation\Traits\HasRecordNavigation;

class EditQismDetail extends EditRecord
{
    protected static string $resource = QismDetailResource::class;

    // use EditTrait;

    protected function getHeaderActions(): array
    {
        return [
            RelationManagerAction::make('mapel')
                ->label('Assign Mapel')
                ->record($this->getRecord())
                ->modalWidth('full')
                ->relationManager(MapelsRelationManager::make()),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Action::make('Back to List')
                ->url($this->getResource()::getUrl('index')),
        ];
    }
}
