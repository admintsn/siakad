<?php

namespace App\Filament\Admin\Resources\KebutuhanKhususResource\Pages;

use App\Filament\Admin\Resources\KebutuhanKhususResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKebutuhanKhusus extends ViewRecord
{
    protected static string $resource = KebutuhanKhususResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
