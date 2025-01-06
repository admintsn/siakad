<?php

namespace App\Filament\Admin\Resources\DataImtihanResource\Pages;

use App\Filament\Admin\Resources\DataImtihanResource;
use App\ListTrait;
use App\Models\SemesterBerjalan;
use App\Models\TahunAjaranAktif;
use App\Models\TahunBerjalan;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListDataImtihans extends ListRecords
{
    protected static string $resource = DataImtihanResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }

    use ListTrait;

    public function getTabs(): array
    {

        $tb = TahunBerjalan::where('is_active', 1)->first();
        $sm = SemesterBerjalan::where('is_active', 1)->first();

        return [
            'Tahun Ajaran Aktif' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('tahun_berjalan_id', $tb->id)
                    ->where('semester_berjalan_id', $sm->id)),

            'all' => Tab::make(),
        ];
    }
}
