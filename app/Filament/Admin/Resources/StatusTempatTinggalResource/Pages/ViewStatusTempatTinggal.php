<?php

namespace App\Filament\Admin\Resources\StatusTempatTinggalResource\Pages;

use App\Filament\Admin\Resources\StatusTempatTinggalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatusTempatTinggal extends ViewRecord
{
    protected static string $resource = StatusTempatTinggalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
