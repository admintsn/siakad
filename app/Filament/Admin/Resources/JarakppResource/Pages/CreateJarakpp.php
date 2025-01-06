<?php

namespace App\Filament\Admin\Resources\JarakppResource\Pages;

use App\CreateTrait;
use App\Filament\Admin\Resources\JarakppResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateJarakpp extends CreateRecord
{
    protected static string $resource = JarakppResource::class;

    use CreateTrait;
}
