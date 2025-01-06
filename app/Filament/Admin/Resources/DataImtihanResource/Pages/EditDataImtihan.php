<?php

namespace App\Filament\Admin\Resources\DataImtihanResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\DataImtihanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataImtihan extends EditRecord
{
    protected static string $resource = DataImtihanResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\ViewAction::make(),
    //         Actions\DeleteAction::make(),
    //     ];
    // }

    use EditTrait;
}
