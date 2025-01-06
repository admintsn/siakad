<?php

namespace App\Filament\Admin\Resources\TransppResource\Pages;

use App\EditTrait;
use App\Filament\Admin\Resources\TransppResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTranspp extends EditRecord
{
    protected static string $resource = TransppResource::class;

    use EditTrait;
}
