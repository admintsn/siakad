<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\UserResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Action::make('Back to List')
    //             ->url($this->getResource()::getUrl('index')),
    //     ];
    // }

    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }

    use CreateTrait;
}
