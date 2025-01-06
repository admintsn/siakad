<?php

namespace App\Filament\Admin\Resources\StaffAdminResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\StaffAdminResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStaffAdmin extends EditRecord
{
    protected static string $resource = StaffAdminResource::class;

    use EditTrait;
}
