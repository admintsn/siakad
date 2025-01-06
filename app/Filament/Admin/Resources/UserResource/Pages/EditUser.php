<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\UserResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\ViewAction::make(),
    //         Actions\DeleteAction::make(),
    //         Action::make('Back to List')
    //             ->url($this->getResource()::getUrl('index')),
    //     ];
    // }

    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }
        
use EditTrait;
}
