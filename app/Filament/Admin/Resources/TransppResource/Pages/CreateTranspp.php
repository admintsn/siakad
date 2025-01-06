<?php

namespace App\Filament\Admin\Resources\TransppResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\TransppResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTranspp extends CreateRecord
{
    protected static string $resource = TransppResource::class;

    use CreateTrait;
}
