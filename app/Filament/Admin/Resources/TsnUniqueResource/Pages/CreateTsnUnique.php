<?php

namespace App\Filament\Admin\Resources\TsnUniqueResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TsnUniqueResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateTsnUnique extends CreateRecord
{
    protected static string $resource = TsnUniqueResource::class;

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
