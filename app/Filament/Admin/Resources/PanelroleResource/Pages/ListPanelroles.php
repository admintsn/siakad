<?php

namespace App\Filament\Admin\Resources\PanelroleResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\PanelroleResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPanelroles extends ListRecords
{
    protected static string $resource = PanelroleResource::class;

    use ListTrait;
}
