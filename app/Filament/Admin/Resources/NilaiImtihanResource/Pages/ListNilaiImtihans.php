<?php

namespace App\Filament\Admin\Resources\NilaiImtihanResource\Pages;

use App\Filament\Admin\Resources\NilaiImtihanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNilaiImtihans extends ListRecords
{
    protected static string $resource = NilaiImtihanResource::class;

    public function getBreadcrumb(): ?string
    {
        return null;
    }
}
