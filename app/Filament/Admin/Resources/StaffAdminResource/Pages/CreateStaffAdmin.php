<?php

namespace App\Filament\Admin\Resources\StaffAdminResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\StaffAdminResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStaffAdmin extends CreateRecord
{
    protected static string $resource = StaffAdminResource::class;

    use CreateTrait;
}
