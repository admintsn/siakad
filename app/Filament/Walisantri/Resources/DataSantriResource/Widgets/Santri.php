<?php

namespace App\Filament\Walisantri\Resources\DataSantriResource\Widgets;

use App\Models\KelasSantri;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class Santri extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                KelasSantri::where('tahun_berjalan_id', $tahunberjalanaktif->id)->where('kartu_keluarga', Auth::user()->username)->whereHas('statussantri', function ($query) {
                    $query->where('status', 'aktif');
                })
            )
            ->columns([
                // ...
            ]);
    }
}
