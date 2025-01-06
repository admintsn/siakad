<?php

namespace App\Filament\Admin\Resources\DataSantriResource\Pages;

use App\Filament\Admin\Resources\DataSantriResource;
use App\ListTrait;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListDataSantris extends ListRecords
{
    protected static string $resource = DataSantriResource::class;

    use ListTrait;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'Aktif' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('statussantri', function ($query) {
                    $query->where('stat_santri_id', 3);
                })),
            'Tidak Aktif' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('statussantri', function ($query) {
                    $query->where('stat_santri_id', 4);
                })),
        ];
    }

    public function updatedActiveTab(): void
    {
        $this->resetPage();
        $this->deselectAllTableRecords();
    }
}
