<?php

namespace App\Filament\Walisantri\Resources\DataSantriResource\Widgets;

use App\Models\Walisantri;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class FormulirKedatangan extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Walisantri::where('ak_no_kk', Auth::user()->username)
            )
            ->columns([
                // ...
            ]);
    }
}
