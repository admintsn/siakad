<?php

namespace App\Filament\Admin\Resources\StaffAdminResource\Pages;

use App\Filament\Admin\Resources\StaffAdminResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStaffAdmins extends ListRecords
{
    protected static string $resource = StaffAdminResource::class;

    use ListTrait;
}
