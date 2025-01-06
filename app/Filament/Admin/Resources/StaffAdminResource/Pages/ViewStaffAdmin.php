<?php

namespace App\Filament\Admin\Resources\StaffAdminResource\Pages;

use App\Filament\Admin\Resources\StaffAdminResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStaffAdmin extends ViewRecord
{
    protected static string $resource = StaffAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
